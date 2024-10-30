jQuery(document).ready(function ($) {
  Helpi5.initialize(helpi5_config.api_key);
  if (helpi5_config.button_css) {
    Helpi5.updateButtonStyle(helpi5_config.button_css);
  }
});
