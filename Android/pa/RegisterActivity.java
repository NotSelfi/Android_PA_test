package com.example.pa;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class RegisterActivity extends AppCompatActivity {

    EditText prenomr;
    EditText usernamer;
    EditText passwordRegister;
    EditText zipRegister;
    EditText emailRegister;
    EditText addressRegister;
    EditText cityRegister;
    EditText phoneRegister;
    Button register;
    TextView responseTV;
    ProgressBar loadingPB;

    //private WebView webView;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        prenomr = findViewById(R.id.reg_name);
        usernamer = findViewById(R.id.reg_login);
        passwordRegister = findViewById(R.id.reg_pswd);
        zipRegister = findViewById(R.id.reg_zip);
        emailRegister = findViewById(R.id.reg_mail);
        cityRegister = findViewById(R.id.reg_ville);
        addressRegister = findViewById(R.id.reg_addresse);
        phoneRegister = findViewById(R.id.reg_phone);
        register = findViewById(R.id.reg_submit);
        responseTV = findViewById(R.id.idTVResponse);
        loadingPB = findViewById(R.id.idLoadingPB);
        

        register.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String prenom = prenomr.getText().toString();
                String username = usernamer.getText().toString();
                String mot_de_passe = passwordRegister.getText().toString();
                String email = emailRegister.getText().toString();
                String adresse= addressRegister.getText().toString();
                String ville = cityRegister.getText().toString();
                String code_postal = zipRegister.getText().toString();
                String telephone = phoneRegister.getText().toString();
                if(prenom == "")
                {
                    Toast.makeText(RegisterActivity.this,"Please Enter Name",Toast.LENGTH_SHORT).show();
                }
                else if(username == "")
                {
                    Toast.makeText(RegisterActivity.this,"Please Enter Job",Toast.LENGTH_SHORT).show();
                }else if(mot_de_passe == "")
                {
                    Toast.makeText(RegisterActivity.this,"Please Enter Job",Toast.LENGTH_SHORT).show();
                }else if(email == "")
                {
                    Toast.makeText(RegisterActivity.this,"Please Enter Job",Toast.LENGTH_SHORT).show();
                }else if(adresse == "")
                {
                    Toast.makeText(RegisterActivity.this,"Please Enter Job",Toast.LENGTH_SHORT).show();
                }else if(ville == "")
                {
                    Toast.makeText(RegisterActivity.this,"Please Enter Job",Toast.LENGTH_SHORT).show();
                }else if(code_postal == "")
                {
                    Toast.makeText(RegisterActivity.this,"Please Enter Job",Toast.LENGTH_SHORT).show();
                }else if(telephone == "")
                {
                    Toast.makeText(RegisterActivity.this,"Please Enter Job",Toast.LENGTH_SHORT).show();
                }
                else
                {

                    postData(prenom,username,mot_de_passe,email,adresse,ville,code_postal,telephone);

                }
            }
        });
            }
    private void postData(String prenom, String username, String mot_de_passe, String email, String adresse, String ville, String code_postal, String telephone) {

        // below line is for displaying our progress bar.
        loadingPB.setVisibility(View.VISIBLE);

        // on below line we are creating a retrofit
        // builder and passing our base url
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.1.38/APITEST/")
                // as we are sending data in json format so
                // we have to add Gson converter factory
                .addConverterFactory(GsonConverterFactory.create())
                // at last we are building our retrofit builder.
                .build();
        // below line is to create an instance for our retrofit api class.
        Methods methods = retrofit.create(Methods.class);

        // passing data from our text fields to our modal class.

        Model modal = new Model(prenom,username,mot_de_passe,email,adresse,ville,code_postal,telephone);

        // calling a method to create a post and passing our modal class.
        Call<Model> call = methods.createPost(modal);

        // on below line we are executing our method.
        call.enqueue(new Callback<Model>() {
            @Override
            public void onResponse(Call<Model> call, Response<Model> response) {
                // this method is called when we get response from our api.
                Toast.makeText(RegisterActivity.this, "Data added to API", Toast.LENGTH_SHORT).show();

                // below line is for hiding our progress bar.
                loadingPB.setVisibility(View.GONE);

                // on below line we are setting empty text
                // to our edit text.

                prenomr.setText("");
                usernamer.setText("");
                passwordRegister.setText("");
                emailRegister.setText("");
                addressRegister.setText("");
                cityRegister.setText("");
                zipRegister.setText("");
                phoneRegister.setText("");

                // we are getting response from our body
                // and passing it to our modal class.
                Model responseFromAPI = response.body();

                // on below line we are getting our data from modal class and adding it to our string.
                String responseString = "Response Code : " + response.code() + "\nName : " + responseFromAPI.getName() + "\n" + "Username : " + responseFromAPI.getUsername()+ "\n" + "Username : " + responseFromAPI.getUsername()+ "\n" + "Username : " + responseFromAPI.getUsername();

                // below line we are setting our
                // string to our text view.
                responseTV.setText(responseString);
            }

            @Override
            public void onFailure(Call<Model> call, Throwable t) {
                // setting text to our text view when
                // we get error response from API.
                responseTV.setText("Error found is : " + t.getMessage());
            }
        });
    }
        }


