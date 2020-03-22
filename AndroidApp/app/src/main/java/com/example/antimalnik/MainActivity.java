package com.example.antimalnik;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ImageView;

public class MainActivity extends AppCompatActivity {

    public WebView mywebview;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        mywebview=(WebView)findViewById(R.id.webview);
        WebSettings webSettings=mywebview.getSettings();
        webSettings.setJavaScriptEnabled(true);
        webSettings.setUseWideViewPort(true);
        mywebview.setInitialScale(25);
        mywebview.loadUrl("https://antimalnik.000webhostapp.com/index.php");
        mywebview.setWebViewClient(new WebViewClient());
    }


    //code for back
    @Override
    public void onBackPressed() {
        if(mywebview.canGoBack()){
            mywebview.goBack();
        }
        else{
            super.onBackPressed();
        }

    }

}
