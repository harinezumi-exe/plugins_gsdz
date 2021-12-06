<?php

/*
    Plugin Name: Baner w formie popup-u
    Description: Dodaj baner na stronie głównej w formie popup-u.
    Version: 1.0
    Author: Anna Jaroszyńska
    Author URI: https://www.linkedin.com/in/anna-jaroszyńska-876475214/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class BanerPopup {
    function __construct() {
        add_action('admin_menu', array($this, 'bpMenu'));
        if (get_option('plugin_baner_popup_desktop') && get_option( 'plugin_baner_popup_mobile' )) add_filter('the_content', array($this, 'bpLogic'));
    }

    function bpMenu() {
        // icon - insert svg data directly into code
        $mainPageHook = add_menu_page( 'Baner popup', 'Baner popup', 'manage_options', 'banerpopup', array($this, 'banerPopupPage'), 'data:image/svg+xml;base64,PHN2ZyBpZD0ic3ZnIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgdmlld0JveD0iMCwgMCwgNDAwLDQwMCI+PGcgaWQ9InN2Z2ciPjxwYXRoIGlkPSJwYXRoMCIgZD0iTTIyLjcxMSAyOS4zODAgQyAxMi4wNTQgMzEuNzExLDIuOTc0IDQwLjc2MywwLjkxOSA1MS4xMDcgQyAtMC40MDEgNTcuNzQ3LC0wLjQwMSAzNDMuMDM0LDAuOTE5IDM0OS42NzQgQyAzLjAzOCAzNjAuMzM5LDEyLjAyOSAzNjkuMDg1LDIzLjMxNiAzNzEuNDU5IEMgMzEuOTQ5IDM3My4yNzUsMzY4LjgzMiAzNzMuMjc1LDM3Ny40NjUgMzcxLjQ1OSBDIDM4NS41NTAgMzY5Ljc1OCwzOTEuMTc0IDM2NS45NTMsMzk1LjkwMCAzNTguOTg0IEwgMzk5LjYwOSAzNTMuNTE2IDM5OS42MDkgMjAwLjM2MCBMIDM5OS42MDkgNDcuMjAzIDM5NS44ODYgNDEuNzY2IEMgMzkxLjEzMCAzNC44MjAsMzg1LjQ5MiAzMS4wMTEsMzc3LjQ2NSAyOS4zMjIgQyAzNjkuMjUwIDI3LjU5NCwzMC42MjYgMjcuNjUwLDIyLjcxMSAyOS4zODAgTTU2LjU4OSA1My4xMTggQyA2NS4yNDkgNTcuMzU5LDY2LjA0NyA2OS40NjAsNTguMDY5IDc1LjU0NiBDIDU0LjIxOCA3OC40ODMsNDcuMDM5IDc4LjY4NCw0My4yMTkgNzUuOTYxIEMgMjkuNTc1IDY2LjIzNiw0MS41NjEgNDUuNzU4LDU2LjU4OSA1My4xMTggTTk5LjU1OCA1My4xMTggQyAxMDguNDA5IDU3LjQ1MywxMDguOTQyIDY5Ljk2NiwxMDAuNTMxIDc1Ljk2MSBDIDk3LjAwNyA3OC40NzMsODkuNzAwIDc4LjQ2NSw4Ni4xNjQgNzUuOTQ0IEMgNzIuMzcwIDY2LjExMiw4NC4zNjIgNDUuNjc2LDk5LjU1OCA1My4xMTggTTE0My4zNjAgNTMuMTI1IEMgMTUxLjk4NiA1Ny4zMDEsMTUyLjUwMyA3MC4xMDEsMTQ0LjI4MSA3NS45NjEgQyAxNDAuNzU3IDc4LjQ3MywxMzMuNDUwIDc4LjQ2NSwxMjkuOTE0IDc1Ljk0NCBDIDExNi4wODcgNjYuMDg5LDEyOC4wODMgNDUuNzMwLDE0My4zNjAgNTMuMTI1IE0zNzEuMDk0IDY0Ljg0NCBMIDM3MS4wOTQgNzEuMDk0IDI3MS44NzUgNzEuMDk0IEwgMTcyLjY1NiA3MS4wOTQgMTcyLjY1NiA2NC44NDQgTCAxNzIuNjU2IDU4LjU5NCAyNzEuODc1IDU4LjU5NCBMIDM3MS4wOTQgNTguNTk0IDM3MS4wOTQgNjQuODQ0IE0zNzEuMDk0IDIyMi4yNjYgTCAzNzEuMDk0IDM0Mi45NjkgMjAwLjM5MSAzNDIuOTY5IEwgMjkuNjg4IDM0Mi45NjkgMjkuNjg4IDIyMi4yNjYgTCAyOS42ODggMTAxLjU2MyAyMDAuMzkxIDEwMS41NjMgTCAzNzEuMDk0IDEwMS41NjMgMzcxLjA5NCAyMjIuMjY2ICIgc3Ryb2tlPSJub25lIiBmaWxsPSIjMDAwMDAwIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjwvcGF0aD48L2c+PC9zdmc+', 100 );

        add_submenu_page( 'banerpopup', 'Baner popup', 'Baner', 'manage_options', 'banerpopup', array($this, 'banerPopupPage') );
        add_action( "load-{$mainPageHook}", array($this, 'mainPageAssets') );
    }

    function mainPageAssets() {
        wp_enqueue_style( 'bpAdminCss', plugin_dir_url( __FILE__ ) . 'styles.css' );
    }

    function banerPopupPage() { ?>
        <div class="wrap">
            <h1>Baner na stronie głównej w formie popup-u</h1>

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
            </ol>
            <h3 class="bns-heading bns-heading__small">Usuwanie</h3>
            <ol>
                <li>Usuń linki w poniższych polach</li>
                <li>Kliknij "Zapisz"</li>
            </ol>
            <br>
            <p><strong>Należy wstawić oba linki. Jeśli jedno pole będzie puste, baner nie pojawi się.</strong></p>
            <br>

            <?php if($_POST['justsumbittedpopup'] == 'true') $this->handleForm(); ?>
            <form method="post">
                <input type="hidden" name="justsumbittedpopup" value="true">
                <?php wp_nonce_field( 'saveBannerPopup', 'theNonce' ); ?>
                
                <label for="plugin_baner_popup_desktop">
                    <p>Wybierz baner w wersji <strong>dla komputerów</strong>.</p>
                </label>
                <input class="bp-plugin__input-link" type="text" name="plugin_baner_popup_desktop" id="plugin_baner_popup_desktop" value="<?php echo esc_url( get_option("plugin_baner_popup_desktop") ); ?>">
                
                <label for="plugin_baner_popup_mobile">
                    <p>Wybierz baner w wersji <strong>dla urządzeń mobilnych</strong>.</p>
                </label>
                <input class="bp-plugin__input-link" type="text" name="plugin_baner_popup_mobile" id="plugin_baner_popup_mobile" value="<?php echo esc_url( get_option("plugin_baner_popup_mobile") ); ?>">

                <!-- <label for="plugin_baner_popup">
                    <p>Wybierz baner.</p>
                </label>
                <input class="bp-plugin__input-link" type="text" name="plugin_baner_popup" id="plugin_baner_popup" value="<?php // echo esc_url( get_option("plugin_baner_popup") ); ?>"> -->

                <br>
                <br>

                <input type="submit" name="submit" id="submit" class="button button-primary" value="Zapisz">
                
            </form>
        </div>
    <?php }

    function handleForm() {
        if (wp_verify_nonce( $_POST['theNonce'], 'saveBannerPopup' ) && current_user_can( 'manage_options' )) {
            update_option( 'plugin_baner_popup_desktop', $_POST['plugin_baner_popup_desktop']);
            update_option( 'plugin_baner_popup_mobile', $_POST['plugin_baner_popup_mobile']);
            ?>
            <div class="updated">
                <p>Twój baner został zapisany.</p>
            </div>
        <?php
        } else { ?>
            <div class="error">
                <p>Przepraszamy, nie można wykonać tej akcji.</p>
            </div>
            <?php }
    }

    function bpLogic($content) {
        $banerPopupLinkDesktop = get_option( 'plugin_baner_popup_desktop' );
        $banerPopupLinkMobile = get_option( 'plugin_baner_popup_mobile' );
        
        $data = array(
            "desktop" => $banerPopupLinkDesktop,
            "mobile" => $banerPopupLinkMobile
        );

        ob_start();

        echo $content;
        
        if (is_front_page()) {
            wp_enqueue_script( 'bpFrontend', plugin_dir_url( __FILE__ ) . 'build/index.js', array('wp-element') );
            wp_enqueue_style( 'bpFrontendStyles', plugin_dir_url( __FILE__ ) . 'build/index.css' );

            ?>
            <div class="bp-update-me" id="bp-update-me">
                <pre style="display: none;"><?php echo wp_json_encode( $data ); ?></pre>
            </div>
            <?php
        }

        return ob_get_clean();

    }
    

    
}

$banerPopup = new BanerPopup();


?>