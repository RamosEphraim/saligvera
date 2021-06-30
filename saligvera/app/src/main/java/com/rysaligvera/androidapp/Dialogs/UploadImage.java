package com.rysaligvera.androidapp.Dialogs;

import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.support.v4.content.FileProvider;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatDialogFragment;
import android.util.Base64;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;

import com.rysaligvera.androidapp.ApiClient;
import com.rysaligvera.androidapp.ApiInterface;
import com.rysaligvera.androidapp.R;
import com.rysaligvera.androidapp.ViewBlogPostActivity;
import com.rysaligvera.androidapp.WebResponse;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Date;

import okhttp3.MediaType;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static android.app.Activity.RESULT_OK;

public class UploadImage extends AppCompatDialogFragment {

    private static final String TAG = "UploadImage";
    ImageView image;
    static final int REQUEST_IMAGE_CAPTURE = 1;

    String mCurrentPhotoPath = "";
    String imageFileName = "";
    Uri photoURI;
    Context cc;
    String projectID;

    public String getProjectID() {
        return projectID;
    }

    public void setProjectID(String projectID) {
        this.projectID = projectID;
    }

    public Context getContext() {
        return cc;
    }

    public void setContext(Context cc) {
        this.cc = cc;
    }

    @Override
    public Dialog onCreateDialog(Bundle savedInstanceState) {



        final AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());

        LayoutInflater inflater = getActivity().getLayoutInflater();
        final View view = inflater.inflate(R.layout.dialog_upload, null);


        view.findViewById(R.id.showCamera).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                if(intent.resolveActivity(getActivity().getPackageManager())  != null) {

                    File photo = null;

                    try{
                        photo = createImageFile();
                    }catch (IOException e) {
                        Log.d(TAG, "onClick: " + e.getMessage());
                    }

                    if(photo != null) {
                         photoURI= FileProvider.getUriForFile(getContext(),
                                "com.example.android.fileprovider",
                                photo);
                        intent.putExtra(MediaStore.EXTRA_OUTPUT, photoURI);
                        startActivityForResult(intent, 1);
                    }
                }
            }
        });

        final Button btnUp = view.findViewById(R.id.btnUpload);
        btnUp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //Upload

                if(!imageFileName.equals("") && !mCurrentPhotoPath.equals("")) {

                    btnUp.setText("Uploading Please Wait ... ");

                    ApiInterface apiInterface = ApiClient.getClient().create(ApiInterface.class);
                    Call<WebResponse> call = apiInterface.upload(imageFileName + ".jpg", getProjectID(), convertImagetoBase64String());

                    call.enqueue(new Callback<WebResponse>() {
                        @Override
                        public void onResponse(Call<WebResponse> call, Response<WebResponse> response) {
                            WebResponse sw = response.body();
                            Toast.makeText(getContext(), sw.getMessage(), Toast.LENGTH_LONG).show();

                            btnUp.setText("Upload Complete ");
                            try {
                                Thread.sleep(1500);
                            } catch (InterruptedException e) {
                                e.printStackTrace();
                            }
                            ViewBlogPostActivity.closeDialog();
                        }

                        @Override
                        public void onFailure(Call<WebResponse> call, Throwable t) {
                            Toast.makeText(getContext(), "error : " + t.getMessage(), Toast.LENGTH_LONG).show();

                            btnUp.setText("Upload Failed ");
                        }
                    });
                }
            }
        });
        image = view.findViewById(R.id.imageView);


        builder.setView(view)
                .setTitle("Upload an Image");

        return builder.create();
    }

    private String convertImagetoBase64String(){
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        currentBitmap.compress(Bitmap.CompressFormat.JPEG, 100, byteArrayOutputStream);
        byte[] imgByte = byteArrayOutputStream.toByteArray();
        return Base64.encodeToString(imgByte, Base64.DEFAULT);
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {

       if(requestCode == 1) {
           setPic();
       }
    }

    Bitmap currentBitmap;

    private void setPic() {
        // Get the dimensions of the View
        int targetW = image.getWidth();
        int targetH = image.getHeight();

        // Get the dimensions of the bitmap
        BitmapFactory.Options bmOptions = new BitmapFactory.Options();
        bmOptions.inJustDecodeBounds = true;
        BitmapFactory.decodeFile(mCurrentPhotoPath, bmOptions);
        int photoW = bmOptions.outWidth;
        int photoH = bmOptions.outHeight;

        // Determine how much to scale down the image
        int scaleFactor = Math.min(photoW/targetW, photoH/targetH);

        // Decode the image file into a Bitmap sized to fill the View
        bmOptions.inJustDecodeBounds = false;
        bmOptions.inSampleSize = scaleFactor;
        bmOptions.inPurgeable = true;

        Bitmap bitmap = BitmapFactory.decodeFile(mCurrentPhotoPath, bmOptions);
        currentBitmap = bitmap;
        image.setImageBitmap(bitmap);

        galleryAddPic();
    }


    private File createImageFile() throws IOException {
        // Create an image file name
        String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss").format(new Date());
        imageFileName = "JPEG_" + timeStamp + "_";
        File storageDir = getActivity().getExternalFilesDir(Environment.DIRECTORY_DCIM);
        File image = File.createTempFile(
                imageFileName,  /* prefix */
                ".jpg",         /* suffix */
                storageDir      /* directory */
        );

        // Save a file: path for use with ACTION_VIEW intents
        mCurrentPhotoPath = image.getAbsolutePath();
        return image;
    }

    private void galleryAddPic() {
        Intent mediaScanIntent = new Intent(Intent.ACTION_MEDIA_SCANNER_SCAN_FILE);
        File f = new File(mCurrentPhotoPath);
        Uri contentUri = Uri.fromFile(f);
        mediaScanIntent.setData(contentUri);
        getActivity().sendBroadcast(mediaScanIntent);
    }


}
