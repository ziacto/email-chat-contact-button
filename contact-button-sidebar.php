<?php
/*
Plugin Name: Contact Button Sidebar
Plugin URI: http://www.contactmebutton.com
Description: Contact Button Sidebar allows all your readers and visitors the ability to communicate with you through Chat, Text Messaging, Email, and your Contact Information.
Version: 1.0.23
Author: ContactMeButton.com
Author URI: http://www.contactmebutton.com
*/

/* do no change */

class contact_button_sidebar{


  /* Please do not modify any code. To update your settings please go to the settings menu from your wordpress dashboard. Thanks */

  function contact_button_sidebar(){
     add_filter('admin_menu', 'cmb_sidebar_admin_menu');
     add_filter('plugin_action_links', 'cmb_sidebar_links_setting', 10, 2);
	
     add_option('Sidebar_Contact_Me_Button_Username', 'YOUR-CONTACTMEBUTTON-USERNAME-HERE');
     add_option('Sidebar_Contact_Me_Button_DisplayName', 'YOUR-NAME-HERE');     
     add_option('Sidebar_Contact_Me_Button_buttonType', 'us');     
     add_option('Sidebar_Contact_Me_Button_overlay', 'true');

     if ( !function_exists('register_sidebar_widget') ){  return; }

     register_sidebar_widget('Contact Button Sidebar', array(&$this,'display_cmb_sidebar'));
		
     //Registering the control form.
     register_widget_control('Contact Button Sidebar', 'cmb_sidebar_widget_page_options', 650);     

  }

   

   



  

  function display_cmb_sidebar(){
    $cmb_username = get_option('Sidebar_Contact_Me_Button_Username');
    $cmb_displayName = get_option('Sidebar_Contact_Me_Button_DisplayName');
    $pub = $this->cmb_username;
    
    if( get_option('Sidebar_Contact_Me_Button_overlay') == 'true'){
	    
	if( get_option('Sidebar_Contact_Me_Button_buttonType') == 'me'){
	
	
		$reply = "<br/><center><a href=\"#\" id=\"contactmeimage\" onclick=\"showContactMe();return false;\"><img border=\"0\" src=\"http://static.contactmebutton.com/img/contactmebutton.png\" alt=\"contact me\" title=\"$cmb_displayName\" /></a><script type=\"text/javascript\" src=\"http://www.contactmebutton.com/scripts/initWidget.js\"></script><script type=\"text/javascript\" src=\"http://www.contactmebutton.com/js/jq/$cmb_username/$cmb_displayName.js\"></script></center><br/>";
	    }else{
		$reply = "<br/><center><a href=\"#\" id=\"contactmeimage\" onclick=\"showContactMe();return false;\"><img border=\"0\" src=\"http://static.contactmebutton.com/img/contactusbutton.png\" alt=\"contact me\" title=\"$cmb_displayName\" /></a><script type=\"text/javascript\" src=\"http://www.contactmebutton.com/scripts/initWidget.js\"></script><script type=\"text/javascript\" src=\"http://www.contactmebutton.com/js/jq/$cmb_username/$cmb_displayName.js\"></script></center><br/>";
	    }

            
            
    }else{
           if( get_option('Sidebar_Contact_Me_Button_buttonType') == 'me'){
	
	
		$reply = "<br/><center><a href=\"http://www.contactmebutton.com/contact-me/contact-widget.action?ss_username=$cmb_username&displayName=$cmb_displayName&addRef=t\" \"><img border=\"0\" src=\"http://static.contactmebutton.com/img/contactmebutton.png\" alt=\"contact me\" title=\"$cmb_displayName\" /></a><script type=\"text/javascript\" src=\"http://www.contactmebutton.com/scripts/initWidget.js\"></script><script type=\"text/javascript\" src=\"http://www.contactmebutton.com/js/jq/$cmb_username/$cmb_displayName.js\"></script></center><br/>";
	    }else{
		$reply = "<br/><center><a href=\"http://www.contactmebutton.com/contact-me/contact-widget.action?ss_username=$cmb_username&displayName=$cmb_displayName&addRef=t\"  \"><img border=\"0\" src=\"http://static.contactmebutton.com/img/contactusbutton.png\" alt=\"contact me\" title=\"$cmb_displayName\" /></a><script type=\"text/javascript\" src=\"http://www.contactmebutton.com/scripts/initWidget.js\"></script><script type=\"text/javascript\" src=\"http://www.contactmebutton.com/js/jq/$cmb_username/$cmb_displayName.js\"></script></center><br/>";
	    }


	    

    }
	echo $reply;
	

  }
}
 

function cmb_sidebar_widget_page_options(){
   
 if( $_POST[ 'cmb_sidebar_submit_hidden' ] == 'Y' ) {

     update_option('Sidebar_Contact_Me_Button_Username', $_POST['Sidebar_Contact_Me_Button_Username']);
     update_option( 'Sidebar_Contact_Me_Button_DisplayName', $_POST['Sidebar_Contact_Me_Button_DisplayName']);     
     update_option( 'Sidebar_Contact_Me_Button_buttonType', $_POST['Sidebar_Contact_Me_Button_buttonType']);     
     update_option( 'Sidebar_Contact_Me_Button_overlay', $_POST['Sidebar_Contact_Me_Button_overlay']);
   ?>
   	<div class="updated fade"><p><strong><?php _e('Settings saved.'); ?></strong></p></div>
		<?php
		
    }

    ?>

 <div class="wrap">
    
<h2>Contact Button Setup</h2>
<strong>To Complete the setup of your contact button please:</strong>
<ol>
  <li>Replace "YOUR-CONTACTMEBUTTON-USERNAME-HERE" with your username from contactmebutton.com</li>
  <li>Replace "YOUR-NAME-HERE" with your name to display ex. Company Name, Real Name, Nick name, etc.</li>
  <li>Click Save Changes</li>
  <li><a href="http://www.contactmebutton.com/getting-started/contact-me-widget.jsp" target="_blank">Getting Started Guide</a></li>
</ol>

         <?php wp_nonce_field('update-options'); ?>

<input type="hidden" name="cmb_sidebar_submit_hidden" value="Y">
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e("<strong>ContactMeButton.com username:</strong>", 'cmb_trans_domain' ); ?></th>
            <td><input type="text" size="40" name="Sidebar_Contact_Me_Button_Username" value="<?php echo get_option('Sidebar_Contact_Me_Button_Username'); ?>" /></td>

         </tr>
         <tr valign="top">
            <th scope="row"><?php _e("<strong>Display Name:</strong>", 'cmb_trans_domain' ); ?></th>
            <td><input type="text" size="40" name="Sidebar_Contact_Me_Button_DisplayName" value="<?php echo get_option('Sidebar_Contact_Me_Button_DisplayName'); ?>" /></td>
        </tr>
	<tr valign="top">
            <th scope="row"><?php _e("<strong>Open on mouse over:</strong>", 'cmb_trans_domain' ); ?></th>
            <td><input type="checkbox" name="Sidebar_Contact_Me_Button_overlay" value="true" <?php echo (get_option('Sidebar_Contact_Me_Button_overlay') == 'true' ? 'checked' : ''); ?>/></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e("<strong>Button Type:</strong>", 'cmb_trans_domain' ); ?></th>
            <td><input type="radio" name="Sidebar_Contact_Me_Button_buttonType" value="us" <?php echo (get_option('Sidebar_Contact_Me_Button_buttonType') == 'us' ? 'checked' : ''); ?> /><img src="http://static.contactmebutton.com/img/contactusbutton.png" alt="contact us button"/> or <input type="radio" name="Sidebar_Contact_Me_Button_buttonType" value="me" <?php echo (get_option('Sidebar_Contact_Me_Button_buttonType') == 'me' ? 'checked' : ''); ?> /><img src="http://static.contactmebutton.com/img/contactmebutton.png" alt="contact me button"/> </td>
        </tr>
        
    </table>

    &nbsp;

    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="Sidebar_Contact_Me_Button_Username, Sidebar_Contact_Me_Button_DisplayName,Sidebar_Contact_Me_Button_buttonType, Sidebar_Contact_Me_Button_overlay"/>

<p><i>
<strong>Note:</strong> You will need a <a href="http://www.contactmebutton.com" target="blank">ContactMeButton.com</a> account.  They have 3 different subscriptions options including FREE, click the link below: <br/>

<br/>
<ol>
	<li><a href="https://secure.contactmebutton.com:8443/signup/limited/signupButtonLimited.jsp" target="blank">Free with ads</a> - Includes 60 Email, 50 Text Messages, 40 Chat per month (Free Version) </li>
	<li><a href="https://secure.contactmebutton.com:8443/signup/trial/signupButtonTrial.jsp" target="blank">Free 30 Day Trial</a> - Free 30 day trial for professional or premium</li>
	<li><a href="https://secure.contactmebutton.com:8443/signup/professional/signupButtonProfessional.jsp" target="blank">Professional</a> - Unlimited Email, Unlimited Text Messages, Unlimited Chat, No Ads from $10/month</li>
	<li><a href="https://secure.contactmebutton.com:8443/signup/basic/signupButtonBasic.jsp" target="blank">Premium</a> - Includes 120 Email, 100 Text Messages, 60 Chat, No Ads from $5/month</li>
</ol>

</i></p>


    </div>

  <?php
  }

function cmb_sidebar_links_setting( $links, $file ){
 //Static so we don't call plugin_basename on every plugin row.
	static $this_plugin;

	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);
	
	if ( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=contact-button-sidebar.php">' . __('Contact Button Settings') . '</a>';
		$widgets_link = '<a href="widgets.php">' . __('Widgets') . '</a>';
		array_unshift( $links, $settings_link, $widgets_link ); // before other links
	}
	return $links;
}





function cmb_sidebar_admin_menu()
{
	
	if( current_user_can('manage_options') ) {
		add_options_page(
			'Contact Button Sidebar: '. __("Contact Button Sidebar", "email-chat-contact-button"). " " . __("Settings")
			, __("Contact Button Sidebar", "contact-button-sidebar")
			, 8 
			, basename(__FILE__)
			, 'cmb_sidebar_plugin_options'
		);
	}

}
function cmb_sidebar_plugin_options()
{
?>
    <div class="wrap">
<h2>Contact Button Setup</h2>
<strong>To Complete the setup of your contact button please:</strong>
<ol>
  <li>Replace "YOUR-CONTACTMEBUTTON-USERNAME-HERE" with your username from contactmebutton.com</li>
  <li>Replace "YOUR-NAME-HERE" with your name to display ex. Company Name, Real Name, Nick name, etc.</li>
  <li>Click Save Changes</li>
  <li><a href="http://www.contactmebutton.com/getting-started/contact-me-widget.jsp" target="_blank">Getting Started Guide</a></li>
</ol>

     <form method="post" action="options.php">
     <?php wp_nonce_field('update-options'); ?>

    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e("<strong>ContactMeButton.com username:</strong>", 'cmb_trans_domain' ); ?></th>
            <td><input type="text" size="40" name="Sidebar_Contact_Me_Button_Username" value="<?php echo get_option('Sidebar_Contact_Me_Button_Username'); ?>" /></td>

         </tr>
         <tr valign="top">
            <th scope="row"><?php _e("<strong>Display Name:</strong>", 'cmb_trans_domain' ); ?></th>
            <td><input type="text" size="40" name="Sidebar_Contact_Me_Button_DisplayName" value="<?php echo get_option('Sidebar_Contact_Me_Button_DisplayName'); ?>" /></td>
        </tr>
	<tr valign="top">
            <th scope="row"><?php _e("<strong>Open on mouse over:</strong>", 'cmb_trans_domain' ); ?></th>
            <td><input type="checkbox" name="Sidebar_Contact_Me_Button_overlay" value="true" <?php echo (get_option('Sidebar_Contact_Me_Button_overlay') == 'true' ? 'checked' : ''); ?>/></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e("<strong>Button Type:</strong>", 'cmb_trans_domain' ); ?></th>
            <td><input type="radio" name="Sidebar_Contact_Me_Button_buttonType" value="us" <?php echo (get_option('Sidebar_Contact_Me_Button_buttonType') == 'us' ? 'checked' : ''); ?> /><img src="http://static.contactmebutton.com/img/contactusbutton.png" alt="contact us button"/> or <input type="radio" name="Sidebar_Contact_Me_Button_buttonType" value="me" <?php echo (get_option('Sidebar_Contact_Me_Button_buttonType') == 'me' ? 'checked' : ''); ?> /><img src="http://static.contactmebutton.com/img/contactmebutton.png" alt="contact me button"/> </td>
        </tr>
        
    </table>

    &nbsp;

    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="Sidebar_Contact_Me_Button_Username, Sidebar_Contact_Me_Button_DisplayName,Sidebar_Contact_Me_Button_buttonType, Sidebar_Contact_Me_Button_overlay"/>
    <p class="submit">
            <input class="button-primary" type="submit" name="Submit" value="<?php _e('Save Changes', 'contact-button-sidebar' ) ?>" />
        </p>
     </form>

<p><i>
<strong>Note:</strong> You will need a <a href="http://www.contactmebutton.com" target="blank">ContactMeButton.com</a> account.  They have 3 different subscriptions options including FREE, click the link below: <br/>

<br/>
<ol>
	<li><a href="https://secure.contactmebutton.com:8443/signup/limited/signupButtonLimited.jsp" target="blank">Free with ads</a> - Includes 60 Email, 40 Chat per month (Free Version) </li>
	<li><a href="https://secure.contactmebutton.com:8443/signup/trial/signupButtonTrial.jsp" target="blank">Free 30 Day Trial</a> - Free 30 day trial for professional or premium</li>
	<li><a href="https://secure.contactmebutton.com:8443/signup/professional/signupButtonProfessional.jsp" target="blank">Professional</a> - Unlimited Email, Unlimited Chat, No Ads from $10/month</li>
	<li><a href="https://secure.contactmebutton.com:8443/signup/basic/signupButtonBasic.jsp" target="blank">Premium</a> - Includes 120 Email, 60 Chat, No Ads from $5/month</li>
</ol>

</i></p>

    </div>

<?php
 }


$cmb &= new contact_button_sidebar();

?>