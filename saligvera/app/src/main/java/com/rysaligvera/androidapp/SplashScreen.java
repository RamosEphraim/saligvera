package com.rysaligvera.androidapp;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Handler;
import android.os.Bundle;

import com.rysaligvera.androidapp.R;

public class SplashScreen extends Activity {

    public static int splash_interval = 3000;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash_screen);

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                SharedPreferences prefs = getSharedPreferences(AppConstants.SHARED_PREFS_NAME, MODE_PRIVATE);
                String restoredText = prefs.getString("username", null);
                if (restoredText != null) {
                    Intent login_intent = new Intent(getApplicationContext(), MainActivity.class);
                    startActivity(login_intent);
                }else{
                    Intent login_intent = new Intent(getApplicationContext(), LoginActivity.class);
                    startActivity(login_intent);
                }
                finish();
            }
        }, splash_interval);
    }
}
