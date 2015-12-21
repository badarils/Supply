package api;

import android.content.Context;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import base.MainApplication;
import cache.CacheManager;
import login.dto.ResponseData;

/**
 * Created by Arbind on 12/21/2015.
 */
public class SupplyApi {
    private static SupplyApi sInstance;
    private RequestQueue mRequestQueue;
    private Context mContext;
    private CacheManager cacheManager = MainApplication.getCacheManager();

    private SupplyApi(Context context) {
        mContext = context;
        mRequestQueue = Volley.newRequestQueue(mContext.getApplicationContext());
    }

    public static SupplyApi getInstance(Context context) {
        if (sInstance == null) {
            sInstance = new SupplyApi(context);
        }
        return sInstance;
    }

    public void loginRequest(final Response.Listener<ResponseData> listener,
                                      final Response.ErrorListener errorListener, String mobileNumber, String password) {

        mRequestQueue.add(new LoginRequest(listener, errorListener, mobileNumber, password));
    }

    /*public void clearQueue(){
        mRequestQueue.cancelAll();
    }*/
}
