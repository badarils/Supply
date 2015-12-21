package util;


import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import java.io.IOException;
import java.net.MalformedURLException;
import java.net.SocketTimeoutException;
import java.net.URL;
import java.net.URLConnection;

import logger.Log;

/**
 * Created by Arbind on 12/19/2015.
 */
public class NetworkStateManager {

    private final ConnectivityManager connectivityManager;
    boolean isHostResolved = false;

    public NetworkStateManager(ConnectivityManager connectivityManager) {
        this.connectivityManager = connectivityManager;
    }

    public boolean isOnline() {
        NetworkInfo netInfoMob = connectivityManager.getNetworkInfo(connectivityManager.TYPE_MOBILE);
        NetworkInfo netInfoWifi = connectivityManager.getNetworkInfo(connectivityManager.TYPE_WIFI);
        if (netInfoMob != null && netInfoMob.isConnectedOrConnecting()) {
            Log.v("Mobile Internet connected");
            return isHostResolved();
        }
        if (netInfoWifi != null && netInfoWifi.isConnectedOrConnecting()) {
            Log.v("Wifi Internet connected");
            return isHostResolved();
        }
        return false;
    }

    private boolean isHostResolved() {
        Thread hostResolveThread = new Thread(new Runnable() {

            @Override public void run() {
                try {
                    URL url = new URL("http://www.google.com");
                    URLConnection urlConnection = url.openConnection();
                    urlConnection.setConnectTimeout(1000);
                    urlConnection.connect();
                    isHostResolved = true;
                } catch (MalformedURLException e) {
                    isHostResolved = false;
                    Log.e("isHostResolved() -> MalformedURLException occurred: " + e.getMessage());
                    e.printStackTrace();
                } catch (SocketTimeoutException e) {
                    isHostResolved = false;
                    Log.e("isHostResolved() -> SocketTimeoutException occurred: " + e.getMessage());
                    e.printStackTrace();
                } catch (IOException e) {
                    isHostResolved = false;
                    Log.e("isHostResolved() -> IOException occurred: " + e.getMessage());
                    e.printStackTrace();
                }
            }
        });

        hostResolveThread.start();

        try {
            hostResolveThread.join();
        } catch (InterruptedException e) {
            isHostResolved = false;
            Log.e("isHostResolved() -> InterruptedException occurred: " + e.getMessage());
            e.printStackTrace();
        }

        return isHostResolved;
    }
}
