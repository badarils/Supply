package util;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.util.Log;

import com.android.volley.AuthFailureError;
import com.android.volley.NetworkError;
import com.android.volley.NetworkResponse;
import com.android.volley.NoConnectionError;
import com.android.volley.ParseError;
import com.android.volley.ServerError;
import com.android.volley.TimeoutError;
import com.android.volley.VolleyError;

import org.json.JSONException;
import org.json.JSONObject;

import java.lang.ref.WeakReference;

import mobileapp.msupply.com.supplier.R;
import ui.ErrorScreenFragment;

/**
 * Created by Arbind on 12/21/2015.
 */
public class ErrorMessageHandler <T extends Context> {
    private final WeakReference<T> contextReference;
    private final String message;
    private Bundle bundle;

    public ErrorMessageHandler(T context, String message) {
        this.contextReference = new WeakReference<T>(context);
        this.bundle = new Bundle();
        this.message = message;
        bundle.putString(BundleIntentKeys.ERROR_MESSAGE, message);
    }

    private String prepareErrorMsgFromVolleyError(VolleyError error) {
        final StringBuilder buffer = new StringBuilder();
        if (error != null) {
            NetworkResponse response = error.networkResponse;
            if (error instanceof NoConnectionError) {
                buffer.append(contextReference.get().getString(R.string.error_no_internet_connection));
            } else if (error instanceof ServerError) {
                buffer.append(contextReference.get().getString(R.string.error_server));
            } else if (error instanceof AuthFailureError) {
                buffer.append(contextReference.get().getString(R.string.error_no_auth));
            } else if (error instanceof ParseError) {
                buffer.append(contextReference.get().getString(R.string.error_parser));
            } else if (error instanceof TimeoutError) {
                buffer.append(contextReference.get().getString(R.string.error_timeout));
            } else if (error instanceof NetworkError) {
                buffer.append(contextReference.get().getString(R.string.error_no_network));
            }
            if (response != null && response.data != null) {
                buffer.append(trimMessage(new String(response.data)));
            }
        } else {
            buffer.append(contextReference.get().getString(R.string.error_server));
        }

        return buffer.toString();
    }

    public void callErrorFragment() {

        if (contextReference.get() instanceof FragmentActivity) {
            FragmentActivity fragmentActivity = (FragmentActivity) contextReference.get();

            Fragment errorFragment = new ErrorScreenFragment();
            if (bundle != null) errorFragment.setArguments(bundle);
            fragmentActivity.getSupportFragmentManager()
                    .beginTransaction()
                    //.replace(R.id.content_frame, errorFragment)
                    .addToBackStack(null)
                    .commitAllowingStateLoss();
        }
    }

    private String trimMessage(String data) {
        Log.e("ErrorMessageHandler", data);
        String trimmedString = "";

        try {
            JSONObject obj = new JSONObject(data);
            trimmedString = obj.getString("message");
        } catch (JSONException e) {
            e.printStackTrace();
            return "";
        }

        return trimmedString;
    }
}
