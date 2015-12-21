package api;

import java.util.HashMap;
import java.util.Map;

import com.android.volley.Response.*;
import com.android.volley.VolleyError;
import com.google.gson.Gson;


/**
 * Created by Arbind on 12/19/2015.
 */
public class SupplyRequest <T> extends GsonRequest<T> {

    /**
     * The default socket timeout in milliseconds
     */
    public static final int DEFAULT_TIMEOUT_MS = 15000;

    /**
     * The default number of retries
     */
    public static final int DEFAULT_MAX_RETRIES = 1;

    /**
     * The default backoff multiplier
     */
    public static final float DEFAULT_BACKOFF_MULT = 1f;

    public static Map<String, String> getHeader() {
        Map<String, String> header = new HashMap<>();
        header.put("Content-Type", "application/json; charset=utf-8");
        header.put("tenant_id", "mSupply");
        header.put("clientIp", "0.0.0.0");
        return header;
    }

    public SupplyRequest(int method, String url, Class<T> clazz, Listener<T> listener,
                         ErrorListener errorListener, String apiType) {
        super(method, url, clazz, listener, errorListener, getHeader(), apiType);
    }

    public SupplyRequest(int method, String url, Class<T> clazz, Listener<T> listener,
                         ErrorListener errorListener, String param, String apiType) {
        super(method, url, clazz, listener, errorListener, getHeader(), param, apiType);
    }

    public SupplyRequest(int method, String url, Class<T> clazz, Listener<T> listener,
                         ErrorListener errorListener, Gson gson, String apiType) {
        super(method, url, clazz, listener, errorListener, gson, apiType);
    }

    public SupplyRequest(int method, String url, Class<T> clazz, Listener<T> listener,
                         ErrorListener errorListener, Map<String, String> headers, String apiType) {

        super(method, url, clazz, listener, errorListener, getHeader(), apiType);
    }

    @Override
    public void deliverError(VolleyError error) {
        super.deliverError(error);
    }


}