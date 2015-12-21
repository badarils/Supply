package util;

import base.MainApplication;
import cache.CacheKeys;
import cache.Result;
import logger.Log;

/**
 * Created by Arbind on 12/19/2015.
 */
public class Config {
    private static String baseUrl = "http://52.30.181.28:8082/";


    public static String getBaseUrl() {

        return baseUrl;
       /* Result<String> result =
                MainApplication.getCacheManager().get(CacheKeys.CONFIG_BASE_URL, String.class);
        if (result == null || result.getCachedObject() == null) {
            Log.e("Something bad happened while saving config url");
            setBaseUrl(baseUrl);
            return baseUrl;
        } else {
            return result.getCachedObject();
        }*/
    }

    public static void setBaseUrl(String baseUrl) {
        boolean result =
                MainApplication.getCacheManager().put(CacheKeys.CONFIG_BASE_URL, baseUrl, String.class);
        if (!result) {
            Log.e("Something bad happened while saving config url");
        }
        Config.baseUrl = baseUrl;
    }
}
