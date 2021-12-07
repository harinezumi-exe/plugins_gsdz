<?php

/*
    Plugin Name: Baner na stronie
    Description: Dodaj baner na stronie głównej.
    Version: 1.0
    Author: Anna Jaroszyńska
    Author URI: https://www.linkedin.com/in/anna-jaroszyńska-876475214/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class BanerNaStronie {
    function __construct() {
        add_action('admin_menu', array($this, 'bnsMenu'));
        if (get_option('plugin_baner_desktop') && get_option('plugin_baner_mobile')) add_filter('the_content', array($this, 'bnsLogic'));
    }

    function bnsMenu() {
        // icon - insert svg data directly into code
        $mainPageHook = add_menu_page( 'Baner na stronie', 'Baner na stronie', 'manage_options', 'banernastronie', array($this, 'banerNaStroniePage'), 'data:image/svg+xml;base64,PHN2ZyBpZD0ic3ZnIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iNDAwIiBoZWlnaHQ9IjM1NC4zMzMzMzMzMzMzMzMzIiB2aWV3Qm94PSIwLCAwLCA0MDAsMzU0LjMzMzMzMzMzMzMzMzMiPjxnIGlkPSJzdmdnIj48cGF0aCBpZD0icGF0aDAiIGQ9Ik00NC41MDAgMjIuMjEyIEMgMzAuNjgyIDI1LjA2MSwyMS40NjkgMzMuNzUzLDE4Ljg2MyA0Ni40MDMgQyAxOC4xMDMgNTAuMDg5LDE4LjA0NyAyODYuNDU2LDE4LjgwNSAyOTAuMzg3IEMgMjEuMTEzIDMwMi4zNjMsMzAuNzkzIDMxMi4wNjksNDIuODMzIDMxNC40ODEgQyA0Ny4yMTAgMzE1LjM1OCwzNTguOTAzIDMxNS4xMDQsMzYxLjgzMyAzMTQuMjIyIEMgMzczLjA5MSAzMTAuODMwLDM4MS4yNzUgMzAyLjI2MCwzODMuODgzIDI5MS4xMzAgQyAzODQuODEzIDI4Ny4xNjQsMzg0Ljg1MSA0OS41MzEsMzgzLjkyMiA0NS45MjEgQyAzODAuOTYyIDM0LjQwOSwzNzMuMzgzIDI2LjQ3MCwzNjEuOTc4IDIyLjkzNSBMIDM1OS41MDAgMjIuMTY3IDIwMi4zMzMgMjIuMTIxIEMgMTE1Ljg5MiAyMi4wOTYsNDQuODY3IDIyLjEzNyw0NC41MDAgMjIuMjEyIE0zNTYuMTgwIDQ3LjI5MyBDIDM1Ny44MjQgNDguMDQwLDM1OS4xOTEgNDkuNjAyLDM1OS42NTIgNTEuMjYwIEMgMzYwLjEzOCA1My4wMDksMzYwLjEzMiAyODQuMDEwLDM1OS42NDcgMjg1Ljc1OSBDIDM1OS4yMTIgMjg3LjMyNiwzNTcuNTI0IDI4OS4yODgsMzU2LjA5OSAyODkuODgzIEMgMzU0LjExMSAyOTAuNzE0LDQ4LjAzNSAyOTAuNTM1LDQ2LjQwMyAyODkuNzAyIEMgNDQuOTg5IDI4OC45ODAsNDQuMzA3IDI4OC4yODIsNDMuNTQwIDI4Ni43NjcgQyA0My4wNDUgMjg1Ljc4OSw0My4wMDAgMjc1Ljg4Niw0My4wMDAgMTY4LjQxNSBMIDQzLjAwMCA1MS4xMzEgNDMuOTU3IDQ5LjYyMSBDIDQ0LjU3OSA0OC42NDEsNDUuNDI1IDQ3Ljg1OSw0Ni4zNzQgNDcuMzkwIEwgNDcuODMzIDQ2LjY2NyAyMDEuMzMzIDQ2LjY3NCBDIDM0OS41MzUgNDYuNjgxLDM1NC44ODAgNDYuNzAyLDM1Ni4xODAgNDcuMjkzIE05OS4zMzMgNzEuMDEyIEMgNzIuNzkxIDc0LjE2NSw1OC4zNTUgMTA0LjM3NCw3Mi41OTYgMTI2Ljk2MCBDIDg5LjU3NCAxNTMuODg3LDEzMC4yNzcgMTQ4LjE0NSwxMzkuMTM2IDExNy41NzMgQyAxNDYuMzkxIDkyLjUzOSwxMjUuMzQ3IDY3LjkyMSw5OS4zMzMgNzEuMDEyIE0yMDcuNDE3IDE1MC4wODMgTCAxNTguNjY4IDE5OC44MzIgMTQzLjQxNiAxODMuNTgzIEwgMTI4LjE2NSAxNjguMzM0IDk3LjU4MiAxOTguOTE4IEwgNjcuMDAwIDIyOS41MDEgNjcuMDAwIDI0Ny45MTcgTCA2Ny4wMDAgMjY2LjMzMyAyMDEuMzMzIDI2Ni4zMzMgTCAzMzUuNjY3IDI2Ni4zMzMgMzM1LjY2NyAyMjMuNDE2IEwgMzM1LjY2NyAxODAuNDk5IDI5Ni4wODMgMTQwLjkxNiBDIDI3NC4zMTIgMTE5LjE0NiwyNTYuNDI0IDEwMS4zMzMsMjU2LjMzMyAxMDEuMzMzIEMgMjU2LjI0MSAxMDEuMzMzLDIzNC4yMjkgMTIzLjI3MCwyMDcuNDE3IDE1MC4wODMgIiBzdHJva2U9Im5vbmUiIGZpbGw9IiMwMDAwMDAiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PC9wYXRoPjwvZz48L3N2Zz4=', 100 );

        add_submenu_page( 'banernastronie', 'Baner na stronie', 'Baner', 'manage_options', 'banernastronie', array($this, 'banerNaStroniePage') );
        add_action( "load-{$mainPageHook}", array($this, 'mainPageAssets') );
    }

    function mainPageAssets() {
        wp_enqueue_style( 'bnsAdminCss', plugin_dir_url( __FILE__ ) . 'styles.css' );
    }

    function banerNaStroniePage() { ?>
        <div class="wrap">
            <h1 class="bns-heading bns-heading__large">Baner na stronie głównej</h1>

            <h2 class="bns-heading bns-heading__medium">Zalecane wymiary banerów:</h2>
            <ul>
                <li>Wersja dla komputerów: 1920 x 500 px</li>
                <li>Wersja dla urządzeń mobilnych: 1920 x 1000 px</li>
            </ul>
            <h2 class="bns-heading bns-heading__medium">Instrukcja:</h2>
            <h3 class="bns-heading bns-heading__small">Dodawanie</h3>
            <ol>
                <li>Wstaw banery (zdjęcia) do biblioteki mediów
                    <ol class="bns-ol__indented">
                        <li>Przejdź do zakładki "Media"</li>
                        <li>Kliknij "Dodaj nowe"</li>
                        <li>Wybierz obrazy i zatwierdź</li>
                    </ol>
                </li>
                <li>Skopiuj odpowiednie URL
                    <ol class="bns-ol__indented">
                        <li>W bibliotece mediów kliknij na miniaturę obrazu - pojawi się okno z obrazem w większym rozmiarze i informacjami o nim</li>
                        <li>Po prawej znajdź pole "Adres URL pliku"</li>
                        <li>Kliknij przycisk "Skopiuj adres URL do schowka"</li>
                    </ol>
                </li>
                <li>Wstaw do pola poniżej</li>
                <li>Kliknij "Zapisz"</li>
                <li>Sprawdź szablon szablon strony głównej (Home), powinien to być "Twentig - No title"
                    <ol class="bns-ol__indented">
                        <li>Przejdź do zakładki "Strony"</li>
                        <li>Wybierz "Home - Strona główna"</li>
                        <li>W edytorze strony kliknij na ikonę koła zębatego w prawym górnym rogu aby wyświetlić ustawienia</li>
                        <li>W sekcji "Atrybuty strony" sprawdź, czy jest wybrany szablon "Twentig - No title"</li>
                    </ol>
                </li>
            </ol>
            <h3 class="bns-heading bns-heading__small">Usuwanie</h3>
            <ol>
                <li>Usuń linki w poniższych polach</li>
                <li>Kliknij "Zapisz"</li>
                <li>Sprawdź szablon szablon strony głównej (Home), powinien to być "Twentig - Transparent header"</li>
            </ol>
            <br>
            <p><strong>Należy wstawić oba linki. Jeśli jedno pole będzie puste, baner nie pojawi się.</strong></p>
            <br>
            <?php if($_POST['justsumbittedbanner'] == 'true') $this->handleForm(); ?>
            <form method="post">
                <input type="hidden" name="justsumbittedbanner" value="true">
                <?php wp_nonce_field( 'saveBannerOnPage', 'theNonce' ); ?>
                
                <label for="plugin_baner_desktop">
                    <p>Wybierz baner w wersji <strong>dla komputerów</strong>.</p>
                </label>
                <input class="bns-plugin__input-link" type="text" name="plugin_baner_desktop" id="plugin_baner_desktop" value="<?php echo esc_url( get_option("plugin_baner_desktop") ); ?>">
                
                <label for="plugin_baner_mobile">
                    <p>Wybierz baner w wersji <strong>dla urządzeń mobilnych</strong>.</p>
                </label>
                <input class="bns-plugin__input-link" type="text" name="plugin_baner_mobile" id="plugin_baner_mobile" value="<?php echo esc_url( get_option("plugin_baner_mobile") ); ?>">

                <br>
                <br>

                <input type="submit" name="submit" id="submit" class="button button-primary" value="Zapisz">
                
            </form>
        </div>
    <?php }

    function handleForm() {
        if (wp_verify_nonce( $_POST['theNonce'], 'saveBannerOnPage' ) && current_user_can( 'manage_options' )) {
            update_option( 'plugin_baner_desktop', $_POST['plugin_baner_desktop']);
            update_option( 'plugin_baner_mobile', $_POST['plugin_baner_mobile'] );
            $id = 155;
            if( !$_POST['plugin_baner_desktop'] || !$_POST['plugin_baner_mobile']) {
                update_post_meta( $id, "_wp_page_template", "tw-header-transparent.php");
            } else {
                update_post_meta( $id, "_wp_page_template", "tw-no-title.php");
                }
            ?>
            <div class="updated">
                <p>Twoje banery zostały zapisane.</p>
            </div>
        <?php
        } else { ?>
            <div class="error">
                <p>Przepraszamy, nie można wykonać tej akcji.</p>
            </div>
            <?php }
    }

    function bnsLogic($content) {
        $banerDesktopLink = get_option( 'plugin_baner_desktop' );
        $banerMobileLink = get_option( 'plugin_baner_mobile' );
        
        $data = array(
            "desktop" => $banerDesktopLink,
            "mobile" => $banerMobileLink
        );

        ob_start();
        
        if (is_front_page()) {
            wp_enqueue_script( 'bnsFrontend', plugin_dir_url( __FILE__ ) . 'build/index.js', array('wp-element') );
            wp_enqueue_style( 'bnsFrontendStyles', plugin_dir_url( __FILE__ ) . 'build/index.css' );

            ?>
            <div class="bns-update-me">
                <pre style="display: none;"><?php echo wp_json_encode( $data ); ?></pre>
            </div>
            <?php
        }

        
        echo $content;

        return ob_get_clean();

    }
    

    
}

$banerNaStronie = new BanerNaStronie();


?>