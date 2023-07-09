package com.example.pa;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import android.view.MenuItem;
import android.view.View;
import android.widget.ImageButton;

import android.content.Intent;
import android.widget.PopupMenu;


import com.google.android.material.navigation.NavigationView;

public class MainActivity extends AppCompatActivity {
    private ImageButton menu;
    private NavigationView navigationView;
    private DrawerLayout drawerLayout;
    private ImageButton menuButton;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        navigationView=findViewById(R.id.navigation_view);
        drawerLayout=findViewById(R.id.drawer_layout);
        menu = findViewById(R.id.menu);
        menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                drawerLayout.openDrawer(GravityCompat.START);
            }
        });

        menuButton = findViewById(R.id.profil);

        menuButton.setOnClickListener(new View.OnClickListener() {
            @Override
                public void onClick(View v) {
                    // Create a PopupMenu anchored to the menu button
                    PopupMenu popupMenu = new PopupMenu(MainActivity.this, menuButton);
                    popupMenu.inflate(R.menu.menu_drawer); // Inflate the menu from the XML file
                    popupMenu.setOnMenuItemClickListener(new PopupMenu.OnMenuItemClickListener() {

                        @Override
                        public boolean onMenuItemClick(MenuItem item) {
                            // Handle menu item clicks here
                            int itemId = item.getItemId();
                            switch (itemId) {
                                case R.id.menu_register:
                                    Intent registerIntent = new Intent(MainActivity.this, RegisterActivity.class);
                                    startActivity(registerIntent);
                                    break;
                                case R.id.menu_login:
                                    Intent loginIntent = new Intent(MainActivity.this, LoginActivity.class);
                                    startActivity(loginIntent);
                                    break;
                                case R.id.menu_parameters:
                                    Intent settingsIntent = new Intent(MainActivity.this, SettingsActivity.class);
                                    startActivity(settingsIntent);
                                    break;
                                default:
                                    return false;
                            }
                            drawerLayout.closeDrawer(GravityCompat.START);
                            return true;
                        }
                    });

                    // Show the popup menu
                    popupMenu.show();
                }
            });
        }
    }
