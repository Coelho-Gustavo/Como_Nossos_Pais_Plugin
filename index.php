<?php
    /*
        Plugin Name: Como Nossos Pais
        Description: Inspirado por Hello Dolly plugin, trás um pouco do MPB para os desenvolvedores.
        Author: Coel
        Version 1.2.1
    */

    session_start();
    $_SESSION['conter'];

    function get_lyrics() {
        if ($_SESSION["conter"] >= 69){
            $_SESSION["conter"] = 0;
        }

        $getText = file_get_contents('letra.txt', true);
        $lyrics = explode("\n", $getText);
        $_SESSION["conter"]++;
        
        return wptexturize($lyrics[$_SESSION["conter"] - 1]);   
    }

    function set_lyrics() {
        $lyric = get_lyrics();
        printf('<p id="line"><span dir="ltr" lang="en">%s</span><p>', $lyric);
    }

    add_action('admin_notices', 'set_lyrics');

    function style(){
        echo"
        <style type='text/css'>
            #line {
                float right;
                padding: 5px 10px;
                margin: 0;
                font-size: 12px;
                line-height: 1.6666;
            }
            .rtl #line {
                float: left
            }
            .block-editor-page #line{
                display: none;
            }
            @media screen and (max-width: 782px) {
                #dolly, .rtl #dolly {
                    float: none;
                    padding-left: 0;
                    padding-right: 0;
                }
            }
        </style>
        ";
    }

    add_action('admin_head', 'style');
?>