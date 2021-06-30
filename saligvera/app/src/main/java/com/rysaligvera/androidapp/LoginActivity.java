package com.rysaligvera.androidapp;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.rysaligvera.androidapp.R;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        final EditText txtusername = findViewById(R.id.etusername);
        final EditText txtpassword = findViewById(R.id.etpassword);

        Button btnlogin = findViewById(R.id.btnlogin);
        btnlogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                final ProgressDialog progressDialog = new ProgressDialog(LoginActivity.this);
                progressDialog.setTitle("Loging in...");
                progressDialog.setMessage("Please wait...");
                progressDialog.setCancelable(false);
                progressDialog.show();

                ApiInterface service = ApiClient.getClient().create(ApiInterface.class);
                Call<AccountModel> call = service.login(txtusername.getText().toString(), txtpassword.getText().toString());
                call.enqueue(new Callback<AccountModel>() {
                    @Override
                    public void onResponse(Call<AccountModel> call, Response<AccountModel> response) {
                        if(response.isSuccessful()){
                            if(response.body().getCode().equals("login_success")){

                                AccountModel accountModel = response.body();

                                //save id in shared preferences.
                                SharedPreferences.Editor editor = getSharedPreferences(AppConstants.SHARED_PREFS_NAME, MODE_PRIVATE).edit();
                                editor.putString("name", accountModel.getFirstname() + " " + accountModel.getMiddlename() + " "  + accountModel.getSurname());
                                editor.putString("username", txtusername.getText().toString());
                                editor.putInt("account_id" , accountModel.getAccount_id());
                                editor.apply();

                                Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                                startActivity(intent);

                                Toast.makeText(LoginActivity.this, "Login successful!", Toast.LENGTH_SHORT).show();
                            }
                        }else{
                            Toast.makeText(LoginActivity.this, "Something went wrong...Please try later!", Toast.LENGTH_SHORT).show();
                        }
                        progressDialog.dismiss();
                    }
                    @Override
                    public void onFailure(Call<AccountModel> call, Throwable t) {
                        progressDialog.dismiss();
                        Toast.makeText(LoginActivity.this, "Something went wrong...Please try later!" + t.toString(), Toast.LENGTH_SHORT).show();
                    }
                });
            }
        });
    }
}
