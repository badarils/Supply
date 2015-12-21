package api;

import android.content.Context;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.ImageLoader;
import com.android.volley.toolbox.Volley;

import java.util.List;

/**
 * Created by Arbind on 12/19/2015.
 */
public class ApiManager {
    private RequestQueue mRequestQueue;
    private RequestQueue mImageLoaderQueue;
    private ImageLoader mImageLoader;

    public ApiManager(Context context) {

        mRequestQueue = Volley.newRequestQueue(context.getApplicationContext());
        mImageLoaderQueue =
                Volley.newRequestQueue(context.getApplicationContext()); //not used as of now
    }

    public static long getMinutesDifference(long timeStart, long timeStop) {
        long diff = timeStop - timeStart;
        long diffMinutes = diff / (60 * 1000);
        return diffMinutes;
    }
}
