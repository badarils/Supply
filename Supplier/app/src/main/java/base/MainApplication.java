package base;

import android.app.Application;
import android.content.Context;

import java.io.File;

import api.ApiManager;
import cache.CacheManager;
import logger.FileLog;
import logger.Log;
import mobileapp.msupply.com.supplier.BuildConfig;
import javax.inject.Inject;

/**
 * Created by Arbind on 12/19/2015.
 */
public class MainApplication extends Application {
    @Inject static CacheManager cacheManager;
    @Inject static ApiManager apiManager;

    public static NetworkConnectivityChangeListener networkConnectivityChangeListener;
    private static Context context;


    public interface NetworkConnectivityChangeListener {
        void onNetworkConnected();

        void onNetworkDisconnected();
    }

    @Override public void onCreate() {
        super.onCreate();

        assignLogger();

        MainApplication.context = getApplicationContext();

    }

  /*@Override protected void attachBaseContext(Context base) {
    super.attachBaseContext(base);
    MultiDex.install(this);
  }*/

    public static Context getAppContext() {
        return MainApplication.context;
    }

    public static CacheManager getCacheManager() {
        return cacheManager;
    }

    public static ApiManager getApiManager() {
        return apiManager;
    }


    private void assignLogger() {
        final int LOG_FILE_SIZE = 1000000; //1mb
        if (BuildConfig.BUILD_TYPE.equals("debug")) {
            FileLog.open("sdcard/" + File.separator + BuildConfig.APPLICATION_ID + ".log",
                    android.util.Log.VERBOSE, LOG_FILE_SIZE);
            Log.plant(new Log.DebugTree());
        } else if (BuildConfig.BUILD_TYPE.equals("preRelease")) {
            Log.plant(new Log.ErrorWarningTree());
        } else {
            Log.plant(new CrashReportingTree());
        }
    }

    /**
     * A tree which logs important information for crash reporting.
     */
    private static class CrashReportingTree extends Log.HollowTree {
        @Override public void i(String message, Object... args) {
            // TODO e.g., Crashlytics.log(String.format(message, args));
        }

        @Override public void i(Throwable t, String message, Object... args) {
            i(message, args); // Just add to the log.
        }

        @Override public void e(String message, Object... args) {
            //android.util.Log.e("ERROR: ", message); // Just add to the log.
            //Crashlytics.log(String.format(message, args)); // Report th exception to Crashlytics
        }

        @Override public void e(Throwable t, String message, Object... args) {
            //android.util.Log.e("ERROR: ",message,t); // Just add to the log.
            //Crashlytics.logException(t); // Report th exception to Crashlytics
        }
    }

    public static void setNetworkConnectivity(boolean isNetworkConnected) {
        if (networkConnectivityChangeListener != null) {
            if (isNetworkConnected) {
                networkConnectivityChangeListener.onNetworkConnected();
            } else {
                networkConnectivityChangeListener.onNetworkDisconnected();
            }
        }
    }

    public static void registerNetworkConnectivityChangeListener(
            NetworkConnectivityChangeListener networkConnectivityChangeListener) {
        MainApplication.networkConnectivityChangeListener = networkConnectivityChangeListener;
    }

    public static void unregisterNetworkConnectivityChangeListener() {
        MainApplication.networkConnectivityChangeListener = null;
    }
}
