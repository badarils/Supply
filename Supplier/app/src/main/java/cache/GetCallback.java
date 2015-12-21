package cache;

/**
 * Created by Arbind on 12/19/2015.
 */
public interface GetCallback<T> {
    public void onSuccess(Result<T> object);

    public void onFailure(Exception e);
}

