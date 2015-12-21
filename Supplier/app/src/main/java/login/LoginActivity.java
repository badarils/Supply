package login;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.android.volley.Response;
import com.android.volley.VolleyError;

import api.SupplyApi;
import api.SupplyRequest;
import logger.Log;
import login.dto.ResponseData;
import mobileapp.msupply.com.supplier.R;

/**
 * Created by Arbind on 12/21/2015.
 */
public class LoginActivity extends AppCompatActivity implements View.OnClickListener{

    TextView tv;
    EditText mobNum,pass;
    Button login;
    SupplyRequest supplyRequest;
    SupplyApi supplyApi;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        supplyApi = SupplyApi.getInstance(getApplicationContext());

        tv = (TextView) findViewById(R.id.text);
        mobNum = (EditText)findViewById(R.id.mobNum);
        pass = (EditText)findViewById(R.id.pass);
        login = (Button)findViewById(R.id.btnLogin);


        login.setOnClickListener(new View.OnClickListener(){

            @Override
            public void onClick(View v){

                String mobile = mobNum.getText().toString();
                String password = pass.getText().toString();
                callLogiRequest(mobile, password);

            }
        });
    }

    private void callLogiRequest(String mobileNumber, String password){
        supplyApi.loginRequest(getLoginSuccess(), getLoginFailure(), mobileNumber, password);
    }

    private Response.Listener<ResponseData> getLoginSuccess() {
        return new Response.Listener<ResponseData>() {
            @Override public void onResponse(ResponseData response) {
                if (response != null) {
                    Log.d("response  "+response);

                    tv.setText(response.toString());
                    tv.setText(response.message.serviceProviderEntity.profileInfo.accountInfo.AadharNumber+ " "+
                            response.message.serviceProviderEntity.profileInfo.accountInfo.firstName);
                }
            }
        };
    }

    private Response.ErrorListener getLoginFailure() {
        return new Response.ErrorListener() {

            @Override public void onErrorResponse(VolleyError arg0) {

              // new ErrorMessageHandler<>(getApplicationContext(), arg0).callErrorFragment();
            }
        };
    }

    @Override
    public void onClick(View v) {

    }
}
