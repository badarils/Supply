package api;

import com.android.volley.Response.*;
import com.google.gson.FieldNamingPolicy;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import base.MainApplication;
import cache.CacheKeys;
import cache.CacheManager;
import logger.Log;
import login.dto.LoginPayloadData;
import login.dto.ResponseData;
import util.Config;
import util.Constants;

/**
 * Created by Arbind on 12/21/2015.
 */
public class LoginRequest extends SupplyRequest<ResponseData> {
    public LoginRequest(Listener<ResponseData> listener,
                        ErrorListener errorListener, String mobileNumber, String password) {
        super(Method.POST, Config.getBaseUrl() + Constants.LOGIN_REUEST_PATH,
                ResponseData.class, listener, errorListener, getParam(mobileNumber, password), LoginRequest.class.getName());
    }

    private static String getParam(String mobileNumber, String password) {
        Gson gson = new GsonBuilder().setFieldNamingPolicy(FieldNamingPolicy.LOWER_CASE_WITH_UNDERSCORES).create();
        LoginPayloadData loginPayloadData = new LoginPayloadData();
        loginPayloadData.setMobile(mobileNumber);
        loginPayloadData.setPassword(password);
        return gson.toJson(loginPayloadData);
    }

    @Override
    protected void deliverResponse(ResponseData response) {
        Log.d("CACHEFLOW: Job List response: Inserting into Cache "+response);
       /* MainApplication.getCacheManager()
                .put(CacheKeys.CACHE_LOGIN, response, ResponseData.class, CacheManager.ExpiryTimes.ONE_DAY.asSeconds(),
                        false);*/
        super.deliverResponse(response);
    }
}