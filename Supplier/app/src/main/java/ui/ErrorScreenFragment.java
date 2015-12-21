package ui;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import mobileapp.msupply.com.supplier.R;
import util.BundleIntentKeys;

/**
 * Created by Arbind on 12/21/2015.
 */
public class ErrorScreenFragment extends BaseTrackerFragment {
    @Override public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                       Bundle savedInstanceState) {


        View rootView = inflater.inflate(R.layout.fragment_error_screen, container, false);

        // Set toolbar visible and add back action on back button
        Toolbar toolbar = (Toolbar) getActivity().findViewById(R.id.toolbar);
        toolbar.setAlpha(1.0f);
        ((AppCompatActivity)getActivity()).getSupportActionBar().setTitle("Error");

        // Hide Progress bar
        TextView errorText = (TextView) rootView.findViewById(R.id.error_msg);

        if (getArguments().containsKey(BundleIntentKeys.ERROR_MESSAGE)) {
            errorText.setText(getArguments().getString(BundleIntentKeys.ERROR_MESSAGE));
        }


        return rootView;
    }
}
