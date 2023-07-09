package com.example.pa;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface Methods {

    // as we are making a post request to post a data
    // so we are annotating it with post
    // and along with that we are passing a parameter as users
    @FormUrlEncoded
    @POST("users/")

    //on below line we are creating a method to post our data.
    Call<Model> createPost(@Body Model model);

    //Call<Model> createPost(String prenom, String username, String mot_de_passe, String email, String adresse, String ville, String code_postal, String telephone);
}