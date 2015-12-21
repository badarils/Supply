package cache;

/**
 * Created by Arbind on 12/19/2015.
 */
public interface PutCallback {
    public void onSuccess();

    public void onFailure(Exception e);
}
