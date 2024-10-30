<div class='wrap' >
    <h2><?php _e( 'Helpi5 Settings', 'helpi5' ); ?></h2>
    <form method='post' >
        <table class='form-table' >
            <tr>
                <th>
                    <label for='helpi5_api_key' ><?php _e( 'API key', 'helpi5' ); ?></label>
                </th>
                <td>
                    <input type='text' class='large-text' name='helpi5[api_key]' id='helpi5_api_key' value='<?php echo esc_attr( $settings['api_key']); ?>' />
                    <p class='description' ><?php _e( 'please register on <a href=\'https://www.helpi5.com\' target=\'_blank\' >www.helpi5.com</a> for API key', 'helpi5' ); ?></p>
                </td>
            </tr>
            <tr>
                <th>
                    <label for='helpi5_button_css' ><?php _e( 'Extra Button Styling', 'helpi5' ); ?></label>
                </th>
                <td>
                    <textarea class='large-text code' rows='10' cols='50' name='helpi5[button_css]' id='helpi5_button_css'  ><?php echo esc_textarea( $settings['button_css']); ?></textarea>
                    <p class='description' ><?php _e( 'Accepts valid CSS', 'helpi5' ); ?></p>
                </td>
            </tr>
        </table>
        <input type='hidden' name='action' value='helpi5_save_settings' />
        <?php wp_nonce_field( 'helpi5_save_settings' ); ?>
        <input type='submit' class='button button-primary' value='<?php echo esc_attr(_e('Save Settings', 'helpi5')); ?>' />
    </form>
</div>