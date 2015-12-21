package api;

import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.NetworkResponse;
import com.android.volley.ParseError;
import com.android.volley.Request;
import com.android.volley.Response.*;
import com.android.volley.RetryPolicy;
import com.android.volley.toolbox.HttpHeaderParser;
import com.google.gson.FieldNamingPolicy;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.JsonSyntaxException;

import java.io.UnsupportedEncodingException;
import java.util.Calendar;
import java.util.Map;

import logger.FileLog;
import logger.Log;
import util.Config;

/**
 * Created by Arbind on 12/19/2015.
 */
public abstract class GsonRequest<T> extends Request<T> {
    private final Gson mGson;
    private final Class<T> mClazz;
    private final Listener<T> mListener;
    private final Map<String, String> mHeaders;
    //private final Map<String, String> mParams;
    private String mParams;
    private String mURL;
    private long timeDifference;
    Calendar rightNowTime;
    String mAPIType;

    public GsonRequest(int method, String url, Class<T> clazz, Listener<T> listener,
                       ErrorListener errorListener, String apiType) {
        super(method, url, errorListener);
        Log.i("Invoking GsonRequest for " + url);
        Log.d(clazz.getSimpleName() + " : " + method + " : " + url);

        rightNowTime = Calendar.getInstance();
        timeDifference = rightNowTime.getTimeInMillis();
        mAPIType = apiType;

        FileLog.d("TimeInterval ", "API TYPE " + apiType + " : " + method +
                " : " + url + " Time request send to server " + rightNowTime.getTimeInMillis());


        this.mClazz = clazz;
        this.mListener = listener;
        this.mURL = url;
        mGson = createGson();
        mParams = null;
        mHeaders = null;

        setTimeout(30000); // 30 seconds //already configured in fk-volley in constructor.
    }

    private Gson createGson() {
        /*return new GsonBuilder().setFieldNamingPolicy(FieldNamingPolicy.LOWER_CASE_WITH_UNDERSCORES)
                .setDateFormat("yyyy-MM-dd'T'HH:mm:ss.SSS'Z'")
                .create();*/
        return new GsonBuilder()//.setFieldNamingPolicy(FieldNamingPolicy.LOWER_CASE_WITH_UNDERSCORES)
                .setDateFormat("yyyy-MM-dd'T'HH:mm:ss.SSS'Z'")
                .create();

    }

    public GsonRequest(int method, String url, Class<T> clazz, Listener<T> listener,
                       ErrorListener errorListener, Gson gson, String apiType) {
        super(method, url, errorListener);
        Log.i("Invoking GsonRequest for " + url);
        Log.d(clazz.getSimpleName() + " : " + method + " : " + url);

        rightNowTime = Calendar.getInstance();
        timeDifference = rightNowTime.getTimeInMillis();
        mAPIType = apiType;

        FileLog.d("TimeInterval ", "API TYPE "+apiType+" : " + method +
                " : " + url+ " Time request send to server "+rightNowTime.getTimeInMillis());


        this.mClazz = clazz;
        this.mListener = listener;
        this.mURL = url;
        mGson = gson;
        mParams = null;
        mHeaders = null;

        setTimeout(30000); // 30 seconds
    }

    public GsonRequest(int method, String url, Class<T> clazz, Listener<T> listener,
                       ErrorListener errorListener, Map<String, String> headers, String param, String apiType) {
        super(method, url, errorListener);
        Log.i("Invoking GsonRequest for " + url);
        Log.d(
                clazz.getSimpleName() + " : method=" + method + " : url= " + url + " : headers = " + headers
                        .toString() + " : mParams = " + param);

        rightNowTime = Calendar.getInstance();
        timeDifference = rightNowTime.getTimeInMillis();
        mAPIType = apiType;

        FileLog.d("TimeInterval ", "API TYPE "+apiType+" : " +method +
                " : " + url+ " Time request send to server "+rightNowTime.getTimeInMillis());


        this.mClazz = clazz;
        this.mListener = listener;
        this.mURL = url;
        //this.mParams = params;
        this.mHeaders = headers;
        mGson = createGson();
        this.mParams = param;

        setTimeout(30000); // 30 seconds
    }

    public GsonRequest(int method, String url, Class<T> clazz, Listener<T> listener,
                       ErrorListener errorListener, Map<String, String> headers, String apiType) {
        super(method, url, errorListener);
        Log.i("Invoking GsonRequest for " + url);
        Log.d(
                clazz.getSimpleName() + " : method=" + method + " : url= " + url + " : mParams = " + null);

        rightNowTime = Calendar.getInstance();
        timeDifference = rightNowTime.getTimeInMillis();
        mAPIType = apiType;

        FileLog.d("TimeInterval ", "API TYPE "+apiType+" : " +method + " : " + url+ " Time request send to server "+rightNowTime.getTimeInMillis());


        this.mClazz = clazz;
        this.mListener = listener;
        this.mURL = url;
        //this.mParams = params;
        this.mHeaders = headers;
        mGson = createGson();
        this.mParams = null;

        setTimeout(30000); // 30 seconds
    }

	/*@Override
  protected Map<String, String> getParams() throws AuthFailureError {
		return mParams;
	}*/

    @Override public String getBodyContentType() {
        return "application/json";
    }

    @Override public Map<String, String> getHeaders() throws AuthFailureError {
        return mHeaders != null ? mHeaders : super.getHeaders();
    }

    private void setTimeout(int timeout) {

        RetryPolicy policy = new DefaultRetryPolicy(timeout, DefaultRetryPolicy.DEFAULT_MAX_RETRIES,
                DefaultRetryPolicy.DEFAULT_BACKOFF_MULT);
        setRetryPolicy(policy);
    }

    @Override public byte[] getBody() throws AuthFailureError {
        try {
            return mParams.toString().getBytes(getParamsEncoding());
        } catch (UnsupportedEncodingException e) {
            //Log.d(e);
        }
        return null;
    }

    @Override protected void deliverResponse(T response) {
        mListener.onResponse(response);
    }

    @Override
    protected com.android.volley.Response<T> parseNetworkResponse(NetworkResponse response) {
        try {
            String json = new String(response.data, HttpHeaderParser.parseCharset(response.headers));

            Log.i("Recieving response for " + mURL+"  json****************** "+json);
            Log.d("parseNetworkResponse : "
                    + mClazz.getSimpleName()
                    + " :url="
                    + mURL
                    + " :statusCode="
                    + response.statusCode
                    + " :JSON= "
                    + json);

            rightNowTime = Calendar.getInstance();
            timeDifference = rightNowTime.getTimeInMillis() - timeDifference;
            FileLog.d("TimeInterval ", "Response API Type"+mAPIType+"Recieving response for "+mURL
                    + " :statusCode="
                    + response.statusCode
                    + " :JSON= "
                    + json
                    + " Time request send to server "+rightNowTime.getTimeInMillis()
                    + " Difference "+timeDifference);

            return com.android.volley.Response.success(mGson.fromJson(json, mClazz),
                    HttpHeaderParser.parseCacheHeaders(response));
        } catch (UnsupportedEncodingException e) {
            return com.android.volley.Response.error(new ParseError(e));
        } catch (JsonSyntaxException e) {
            return com.android.volley.Response.error(new ParseError(e));
        }
    }

    protected String getBaseUrl() {
        return Config.getBaseUrl();
    }

}
