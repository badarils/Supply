package ui;

import android.os.Bundle;
import android.support.v4.app.Fragment;

import com.google.android.gms.analytics.GoogleAnalytics;

/**
 * Created by Arbind on 12/21/2015.
 */
public class BaseTrackerFragment extends Fragment {
    @Override public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override public void onStart() {
        super.onStart();
        GoogleAnalytics.getInstance(getActivity()).reportActivityStart(getActivity());
    }

    @Override public void onStop() {
        GoogleAnalytics.getInstance(getActivity()).reportActivityStop(getActivity());
        super.onStop();
    }
}
