<?php
//add_action( 'admin_menu', 'ait_abstracts_menu' );  

function ait_abstracts_menu(){
	$page_title = 'AIT Abstracts';
	$menu_title = 'Abstracts';
	$capability = 'manage_options';
	$menu_slug  = 'ait-abstracts';
	$function   = 'ait_abstracts_menu_page';
	$icon_url   = 'dashicons-media-code';
	$position   = 4;
    add_menu_page(
		$page_title,
		$menu_title,
		$capability,
		$menu_slug,
		$function, 
		$icon_url,
		$position 
	); 
} 
function ait_abstracts_menu_page() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	 if (isset($_POST['myplugin_option_name_submit'])) { 
		update_option( 'myplugin_option_name', $_POST['myplugin_option_name'], null );
		echo 'Changes Saved';
	}

	
	?>
	
	
	
	
<div class="wrap">
  <h1>Abstracts Settings</h1>
  <div>
    <div class="card">
      <h2>Settings Deadlines</h2>
      <p>There are two deadlines that have to be set. The first is for the submission of abstracts and the second is for
        the upload of presentations. To set these times you must be aware that the local time of the server running this
        website is different than Eastern Time on which the deadlines are based. The local time of the web server and
        the equivalent time in Eastern Time are displayed below. As I am writing this explanation the web server is two
        hours behind Eastern Time. This means if you want to set a deadline of 2/1/2013 at 12 midnight Eastern Time, the
        deadline time needs to be set to 2/1/2013 at 10 PM on the web server.</p>
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><label>Web Server Time:</label></th>
          <td></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Eastern Time:</label></th>
          <td></td>
        </tr>
      </table>
    </div>
    <form method="post" action="">
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><label for="myplugin_option_name">Label</label></th>
          <td><input type="text" id="myplugin_option_name" name="myplugin_option_name"
              value="<?php echo get_option('myplugin_option_name'); ?>" /></td>
        </tr>
      </table>
      <p class="submit">
        <input type="submit" name="myplugin_option_name_submit" class="button button-primary" value="Save Changes">
      </p>
    </form>
  </div>
</div><?php
}
function abstracts_frontend( $atts ){

?>

<div class="protect-submission"></div>

<div class="ait-container">
  <ul class="ait-step-navigation">
    <li num="1" class="active"><a href="#" class="ait-step-btn" data-for="ait-step-1">Background Information</a></li>
    <li num="2"><a href="#" class="ait-step-btn" data-for="ait-step-2">Presentation Guidelines</a></li>
    <li num="3"><a href="#" class="ait-step-btn" data-for="ait-step-3">Guideline Quiz</a></li>
    <li num="4"><a href="#" class="ait-step-btn" data-for="ait-step-4">Conflict of Interest</a></li>
    <li num="5"><a href="#" class="ait-step-btn" data-for="ait-step-5">CV Upload</a></li>
    <li num="6"><a href="#" class="ait-step-btn" data-for="ait-step-6">Abstract Submission</a></li>
  </ul>
  <div class="ait-step-main-box">
  
    <!-- START STEP 1 -->
    <div class="ait-step-box" id="ait-step-1">
      <div class="ait-information">
        <div class="ait-begin-box">
          <h3 class="ait-title">Let’s Begin</h3>
          <div class="ait-description">
            <p>Complete the following form to begin the submission process.</p>
            <p>If your institution is not listed in the drop down box or has changed, please select "Other" from the
              dropdown and enter the institutions name in the "Other" text box. Please try to insure that the
              institution name is the same for all residents for that location.</p>
          </div>
        </div>
        <div class="ait-already-box">
          <h3 class="ait-title">Already Started?</h3>
          <div class="ait-description">
            <p>To retrieve a previously saved submission, enter your email address and click "Retrieve". Your progress
              through the submission process will be displayed below.</p>
          </div>
          <div class="ait-already-form">
            <form id="retrieve_form" class="ait-form" action="" method="post">
              <div class="ait-form-field-box">
                <div class="ait-form-field retrieve-block">
                  <label>Email Address</label>
                  <input type="email" class="ait-input-box" style="width:60%" id="retrieve_email" required>
                  <button type="submit" class="ait-button" onclick="event.preventDefault(); retrieve()" style="width: 112px; padding: 20px 16px;">Retrieve</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="ait-information-form">
        <form class="ait-form" action="" method="post" id="basic_information">
          <div class="ait-form-field-box">
            <div class="ait-form-field">
              <label>First Name</label>
              <input type="text" name="first_name" class="ait-input-box" required>
            </div>
            <div class="ait-form-field">
              <label>Last Name</label>
              <input type="text" name="last_name" class="ait-input-box" required>
            </div>
          </div>
          <div class="ait-form-field-box">
            <div class="ait-form-field">
              <label>Degree / Credentials</label>
              <input type="text" name="degree_credentials" class="ait-input-box" required>
            </div>
            <div class="ait-form-field">
              <label>Institution / Site</label>
              <select name="institution_site" class="ait-input-box" style="font-size:12px;" required>
              	<option></option>
              </select>
            </div>
            <div class="ait-form-field">
              <label>Other</label>
              <input type="text" name="other_institution" class="ait-input-box" >
            </div>
          </div>
          <div class="ait-form-field-box">
            <div class="ait-form-field">
              <label>Program</label>
              <select name="program" class="ait-input-box" required>
              	<option value="">-- Select a Program --</option>
              	<option>PGY1</option>
              	<option>PGY2</option>
              	<option>Fellowship</option>
              </select>
            </div>
            <div class="ait-form-field">
              <label>Address-1</label>
              <input type="text" name="address1" class="ait-input-box" required>
            </div>
            <div class="ait-form-field">
              <label>Address 2</label>
              <input type="text" name="address2" class="ait-input-box" >
            </div>
          </div>
          <div class="ait-form-field-box">
            <div class="ait-form-field">
              <label>City</label>
              <input type="text" name="city" class="ait-input-box" required>
            </div>
            <div class="ait-form-field">
              <label>State</label>
              <input type="text" name="state" class="ait-input-box" required>
            </div>
            <div class="ait-form-field">
              <label>Zip Code</label>
              <input type="text" name="zip" class="ait-input-box" required>
            </div>
          </div>
          <div class="ait-form-field-box">
            <div class="ait-form-field">
              <label>Resident Email</label>
              <input type="email" name="resident_email" class="ait-input-box" required>
            </div>
            <div class="ait-form-field">
              <label>Program Director</label>
              <input type="text" name="program_director" class="ait-input-box" required>
            </div>
            <div class="ait-form-field">
              <label>Program Director Email</label>
              <input type="email" name="director_email" class="ait-input-box" required>
            </div>
          </div>
          <div class="ait-form-field-box">
            <div class="ait-form-field text-right">
              <!-- <button type="submit" name="information-submit" class="ait-button f-right" onclick="event.preventDefault();submit_abstract();">Submit</button> -->
              <button type="submit" name="information-submit" class="ait-button" onclick="event.preventDefault();step(1);">Next</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- END STEP 1 -->
    
    <!-- START STEP 2 -->
    <div class="ait-step-box" id="ait-step-2">
      <div class="ait-information">
        <div class="no-border no-padding">
          <h3 class="ait-title">Presentation Guidelines</h3>
          <div class="ait-description">
            <p>Please review the following information carefully.<br />In the following step you will be asked questions pertaining to what you learned here</p>
          </div>
        </div>
      </div>
      <div class="ait-information-form">
        <div class="video-part" style=" width: 88%; height: 539px; background: gray;margin: auto;margin-bottom: 30px;">
          <iframe src="http://glprc.bgsdev.com/abstract-test" style="width:100%;height:100%;"></iframe>
        </div>
      </div>
      <div class="ait-form-field-box">
	<div class="ait-form-field text-right">
	  <button type="submit" name="information-submit" class="ait-button f-left" onclick="step(-1);">Back</button>
	  <button type="submit" name="information-submit" class="ait-button f-right" onclick="step(1);">Next</button>
	</div>
      </div>
    </div>
    <!-- END STEP 2 -->
    
    <!-- START STEP 3 -->
    <div class="ait-step-box" id="ait-step-3">
      <div class="ait-information">
        <div class="no-border no-padding">
          <h3 class="ait-title">Guideline Quiz</h3>
          <div class="ait-description">
            <p>Please review the following information carefully.<br />In the following step you will be asked questions
              pertaining to what you learned here</p>
          </div>
        </div>
      </div>
      <div class="ait-information-form">
        <div>
          <div>
            <label>Completion of a conflict of interest disclosure form:</label>
            <div class="quiz-panel">
              <form>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="A" id="radio1_1">
                  <label class="inline-label" for="radio1_1">is not required if you have nothing to disclose</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="B" id="radio1_2">
                  <label class="inline-label" for="radio1_2">includes financial disclosure of both the speaker and their spouse/partner</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="C" id="radio1_3">
                  <label class="inline-label" for="radio1_3">includes financial disclosure of all stock even if sold over 12 months ago</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="D" id="radio1_4">
                  <label class="inline-label" for="radio1_4">is not required if you are not going to talk about a commercial product</label>
                </div>
              </form>
            </div>
          </div>
          <div>
            <label>Learning objectives:</label>
            <div class="quiz-panel">
              <form>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="A" id="radio2_1">
                  <label class="inline-label" for="radio2_1">must be measurable and specific</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="B" id="radio2_2">
                  <label class="inline-label" for="radio2_2">do not require specific verbs based on activity type</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="C" id="radio2_3">
                  <label class="inline-label" for="radio2_3">are the basis of learning assessment</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="D" id="radio2_4">
                  <label class="inline-label" for="radio2_4">both A and C are correct</label>
                </div>
              </form>
            </div>
          </div>
          <div>
            <label>Active learning:</label>
            <div class="quiz-panel">
              <form>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="A" id="radio3_1">
                  <label class="inline-label" for="radio3_1">for purposes of GLPRC, should use techniques for knowledge and comprehension verbs</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="B" id="radio3_2">
                  <label class="inline-label" for="radio3_2">for purposes of GLPRC, should use techniques for application and evaluation verbs</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="C" id="radio3_3">
                  <label class="inline-label" for="radio3_3">techniques are only required for 1 hour or longer presentations</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="D" id="radio3_4">
                  <label class="inline-label" for="radio3_4">techniques are only required in academic settings</label>
                </div>
              </form>
            </div>
          </div>
          <div>
            <label>Slide sets:</label>
            <div class="quiz-panel">
              <form>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="A" id="radio4_1">
                  <label class="inline-label" for="radio4_1">Do not need to include interactive learning techniques</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="B" id="radio4_2">
                  <label class="inline-label" for="radio4_2">Can use brand names of commercial products</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="C" id="radio4_3">
                  <label class="inline-label" for="radio4_3">Must contain a disclosure statement for the resident and the preceptor mentor</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="D" id="radio4_4">
                  <label class="inline-label" for="radio4_4">Must contain a disclosure statement for the resident and the preceptor mentor</label>
                </div>
              </form>
            </div>
          </div>
          <div>
            <label>Learning assessment questions:</label>
            <div class="quiz-panel">
              <form>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="A" id="radio5_1">
                  <label class="inline-label" for="radio5_1">must relate back to the learning objectives</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="B" id="radio5_2">
                  <label class="inline-label" for="radio5_2">must be true/false in nature</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="C" id="radio5_3">
                  <label class="inline-label" for="radio5_3">are not necessary for presentations less than 30 minutes</label>
                </div>
                <div>
                  <input type="radio" name="quizradio1" class="big-radio" value="D" id="radio5_4">
                  <label class="inline-label" for="radio5_4">use negative-type formats rather than positive-type formats</label>
                </div>
              </form>
            </div>
          </div>
          <div class="ait-form-field-box">
            <div class="ait-form-field text-right">
              <button type="submit" name="information-submit" class="ait-button f-left"
                onclick="step(-1);">Back</button>
              <button type="submit" name="information-submit" class="ait-button f-right"
                onclick="step(1);">Next</button>
            </div>
          </div>
        </div>
      </div>
    </div>	
    <!-- END STEP 3 -->
    
    <!-- START STEP 4 -->
    <div class="ait-step-box" id="ait-step-4">
      <div class="ait-information">
        <div class="no-border no-padding">
          <h3 class="ait-title">Confilct of Interest</h3>
          <div class="ait-description">
            <ul>
                <li>All continuing pharmacy education (CPE) activities should provide for an 
			in-depth presentation with fair and full disclosure and equitable balance. 
			Appropriate topics and learning activities shall be distinguished from topics 
			and learning activities which are promotional or appear to be intended for 
			purpose of endorsing either a specific commercial drug or other commercial 
			product (as contrasted with the generic product/entity and its contents or the 
			general therapeutic area it addresses), or a specific commercial service (as 
			contrasted with the general service area and/or the aspects or problems of 
			professional practice it addresses).</li>
		<li>Commercial interest is defined as any proprietary entity producing health care 
			goods or services, with the exception of non-profit or government organizations 
			and non-health care related companies.</li>
		<li>
			Presentations must give a balanced view of therapeutic options. Use of generic 
			names will contribute to this impartiality. If the CPE educational material or 
			content includes trade names, where available trade names from several companies 
			should be used, not just trade names from a single company.</li>
		<li>An individual must disclose to learners any relevant financial relationship(s) 
			prior to the beginning of the educational activity.</li>
		<li>Disclosure should be described in the slide presentation, usually the second 
			slide (if live presentation) or in any handout.</li>
		<li>For an individual with no relevant financial relationship(s) the learners must 
			be informed that no relevant financial relationship(s) exist.</li>
		<li>If there is a relevant financial relationship, the conflict must be resolved 
			prior to the activity.</li>
		<li>Disclosure due to a relationship with a commercial interest is required if 
			both (a) the relationship is financial and occurred within the past 12 months 
			and (b) the individual has the opportunity to affect the content of CPE about 
			the products or services of that commercial interest.</li>
		<li>Financial relationships are those relationships in which the individual 
			benefits by receiving salary, royalty, intellectual property rights, consulting 
			fee, honoraria, ownership interest (e.g. stocks, stock options or other 
			ownership interest, excluding diversified mutual funds), or other financial 
			benefit. Financial benefits are usually associated with roles such as 
			employment, management position, independent contractor (including contracted 
			research), consulting, speaking and teaching, membership on advisory committees 
			or review panels, board membership, and other activities for which remuneration 
			is received or expected.</li>
		<li>ACPE considers relationships of the person involved in the CPE activity to 
			include financial relationships of a spouse or partner.</li>
		<li>All individuals involved in a activity must sign a conflict of interest 
			declaration, including those on a planning committee.</li>
		<li>Anyone who refuses to sign a conflict of interest declaration may not be 
			involved in the activity.</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="ait-information" style="margin-top: 20px;">
        <div class="no-border no-padding">
          <h5 class="ait-title">PART1: TO BE COMPLETED BY PARTICIPANT (read ACPE guidlines on non-commercialism)</h5>
          <div class="ait-description">
            <div>
              <form id="spouse_partner">
              	<div>
                  <input type="radio" name="conflict_no" class="big-radio" value="true" id="part1_1" checked>
                  <label class="inline-label" for="part1_1">I or my spouse/partner have no actual or potential conflict of interest in relation to this activity.</label>
                </div>
                <div>
                  <input type="radio" name="conflict_no" class="big-radio" value="false" id="part1_2">
                  <label class="inline-label" for="part1_2">I or my spouse/partner have a financial interest/arrangement, affiliation or relationship with one or more organizations that could be perceived as a real or apparent conflict of interest in the context of the subject of this activity, including but not limited to:</label>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="ait-information-form" style="margin-bottom: 35px;">
        <div class="ait-form-field-box">
            <div class="ait-form-field">
              <label>Please give a brief explanation of the conflict</label>
              <textarea name="conflict_explanation" class="ait-input-box" style="height:70px!important;" disabled="disabled"></textarea>
            </div>
        </div>
      </div>
      <div class="ait-information">
        <div class="no-border no-padding">
          <div class="ait-description">
            <div>
              <form id="checkboxgroup4">
              	<div>
                  <input type="checkbox" name="quizradio1" class="big-radio" value="radio 1" id="check_1">
                  <label class="inline-label" for="check_1">I understand the above inforamtion will be disclosed to the audience in advance of the activity verbally (for live activities) and in print.</label>
                </div>
                <div>
                  <input type="checkbox" name="quizradio2" class="big-radio" value="radio 2" id="check_2">
                  <label class="inline-label" for="check_2">I understand that I must submit activity material (i.e. slides, handout, home study program) at least 4 weeks in advance of the event so that it may be reviewed for conflict of interest/potential bias.</label>
                </div>
              	<div>
                  <input type="checkbox" name="quizradio3" class="big-radio" value="radio 1" id="check_3">
                  <label class="inline-label" for="check_3">By submitting this information you are attesting that your statements are true and factual.</label>
                </div>
                <div class="quiz-panel" style="margin-top:20px;">
                  <p><b>I understand that by typing my name in this box, I am affirming the truth of the above conflict of interest declaration. This serves as my signature of agreement.</b></p>
	          <div class="ait-form-field signature-field">
              		<label style="display:none;">Signature</label>
	            <input type="text" name="signature" placeholder="Enter your Full Name" class="ait-input-box" style="width:30%; display:inline-block" required>
             		 <label style="display:none;">Signature Date</label>
	            <input type="date" name="signature_date" placeholder="Signature Date" class="ait-input-box" style="width:30%; display:inline-block; margin-left:9%;" required>
	          </div>	
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="ait-information">
        <div class="no-border no-padding">
          <div class="ait-description">
            <p>As part of the process, each resident's preceptor must fill out a Conflict of Interest and submit a CV for themselves. <br> Please provide your Preceptor's email in the box below. Additionally, please copy this link:<br> <b>https://glprc.com/preceptor-entry and send it to your Preceptor. <b style="color:brown">This is a requirement</b> in the submission process:</b></p>
          </div>
          <div class="ait-description" style="margin-top: 10px;">
            <div>
              <form>	
		<div class="ait-form-field-box">
	          <div class="ait-form-field">
	            <label>Preceptor Email</label>
	            <input type="email" name="preceptor_email" id="preceptor_email" class="ait-input-box" required>
	          </div>
	          <div class="ait-form-field">
	            <label>Retype Preceptor Email</label>
	            <input type="text" name="retype_preceptor_email" id="retype_preceptor_email" class="ait-input-box" required>
	          </div>
	          <div class="ait-form-field">
	            <label>Submit</label>
	            <button type="button" class="ait-input-box" onclick="event.preventDefault(); mailToPreceptor()" style="background: #a06206!important; width: 100%; color: white; font-weight: bold;">Submit Preceptor Email</button>
	          </div>
	        </div>              
	      </form>
            </div>
          </div>
        </div>
      </div>
      <div class="ait-form-field-box" style="margin-top: 30px;">
	<div class="ait-form-field text-right">
	  <button type="submit" name="information-submit" class="ait-button f-left" onclick="step(-1);">Back</button>
	  <button type="submit" name="information-submit" class="ait-button f-right" onclick="step(1);">Next</button>
	</div>
      </div>
    </div>
    <!-- END STEP 4 -->
    
    <!-- START STEP 5 -->
    <div class="ait-step-box" id="ait-step-5">
      <div class="ait-information">
        <div class="no-border no-padding">
          <h3 class="ait-title">CV Upload</h3>
          <div class="ait-description">
            <p>Please click "add my CV" to open a window that will allow you to browse your drives for your CV. Select your CV and click "Open". Verify the correct file was selected then click "Upload".</p>
            <p><b><a id="currentcv_link" href="#" target="_blank">Current CV</a></b> - Note: Some browsers willl change a file extension of .docx to .zip when the file is downloaded. In this casse you must save the file to your hard drive and change the extension from .zip to .docx before opening.</p>
          </div>
        </div>
      </div>
      <div class="ait-information-form">
        <div class="ait-form-field-box">
	  <div class="ait-form-field text-right">
	    <form enctype="multipart/form-data">
	    <input type="file" name="file" id="cv_file" style="display:none;" onchange=upload_cv()>
	    <button type="button" class="ait-button add-cv-btn" style="background-color:#a76503 !important;" onclick="document.getElementById('cv_file').click()"> + Add my CV</button>
	    </form>
	  </div>
        </div>
      </div>
      <div class="ait-form-field-box">
	<div class="ait-form-field text-right">
	  <button type="submit" name="information-submit" class="ait-button f-left" onclick="step(-1);">Back</button>
	  <button type="submit" name="information-submit" class="ait-button f-right" onclick="step(1);">Next</button>
	</div>
      </div>
    </div>
    <!-- END STEP 5 -->
    
    <!-- START STEP 6 -->
    <div class="ait-step-box" id="ait-step-6">
      <div class="ait-information">
        <div class="no-border no-padding">
          <h3 class="ait-title">Abstract Submission</h3>
        </div>
      </div>
      <div class="ait-information-form">
        <div class="ait-form-field-box">
            <div class="ait-form-field">
              <label>Select area of pharmacy practice that is most closely related to your abstract</label>
              <label style="display:none;">Practice Area</label>
              <select name="practice_area" class="ait-input-box" required>
              <select>
            </div>
            <div class="ait-form-field">
              <label>Will off label use (i.e. non-FDA approved uses) be discussed during the presentation?</label>
              <form id="off_label_use_form">
                <input type="radio" name="off_label_use" class="big-radio" value="radio 1" required checked>
                <label class="inline-label" style="display: inline!important;">Yes</label>
                <input type="radio" name="off_label_use" class="big-radio" value="radio 1" style="margin-left:40px;">
                <label class="inline-label" style="display: inline!important;">No</label>
              </form>
            </div>
        </div>
        <div class="ait-form-field-box">
          <div class="ait-form-field">
            <label>Please select the ACPE Topic Designator from the drop down box that your presention topic is most related to:</label>
            <label style="display:none;">ACPE Topic</label>
            <select name="acpe_topic" class="ait-input-box" required>
            	<option value="">-- Select a Topic --</option>
            	<option>01: Disease State/Drug therapy</option>
            	<option>02: AIDS therapy</option>
            	<option>03: Law (related to pharmacy practice)</option>
            	<option>04: General Pharmacy</option>
            	<option>05: Patient Safety</option>
            	<option>06: Immunizations</option>
            	<option>07: Compounding</option>
            </select>
          </div>
        </div>
        <div class="ait-form-field-box">
          <div class="ait-form-field">
            <label>Title of Research Project</label>
            <input type="text" name="title" class="ait-input-box" required>
          </div>
        </div>
        <div class="ait-form-field-box">
          <div class="ait-form-field">
            <label>Author(s) (Include all authors. Provide first names, middle initials, last names. Asterisk the name of the author presenting. Include degree designations)</label>
            <label style="display:none;">Author</label>
            <input type="text" name="authors" class="ait-input-box" required>
          </div>
        </div>
        <div class="ait-form-field-box">
          <div class="ait-form-field">
            <label>Abstract (limit to 300 words or approximately 2200 characters)</label>
            <textarea name="abstract" class="ait-input-box" style="height:180px!important;" required></textarea>
          </div>
        </div>
        <p><b>Learning Objectives</b> - Select a verb from the dropdown box and then complete the objective in the adfacent box. Do not repeat the verb as you are typing.</p>
        
        <div class="ait-form-field-box">
          <div class="ait-form-field">
            <label>Upon completion of this program, participant will be able to:</label>
	    <div class="ait-form-field-box">
	      <div class="ait-form-field order-num">
                <p>1</p>
              </div>
	      <div class="ait-form-field" style="width:40%">
	      	<label style="display:none;">Objective1 Verb</label>
	        <select class="ait-input-box" name="objective1_verb" requried>
	          <option value=" ">--Select an Option--</option>
	          <option>Arrange</option>
		<option>Classify</option>
		<option>Define</option>
		<option>Describe</option>
		<option>Discuss</option>
		<option>Duplicate</option>
		<option>Explain</option>
		<option>Express</option>
		<option>Identify</option>
		<option>Indicate</option>
		<option>Label</option>
		<option>List</option>
		<option>Locate</option>
		<option>Memorize</option>
		<option>Name</option>
		<option>Order</option>
		<option>Outline</option>
		<option>Recall</option>
		<option>Recognize</option>
		<option>Relate</option>
		<option>Repeat</option>
		<option>Report</option>
		<option>Reproduce</option>
		<option>Restate</option>
		<option>Review</option>
		<option>Select</option>
		<option>State</option>
		<option>Translate</option>
	        </select>
	      </div>
	      <div class="ait-form-field">
	      	<label style="display:none;">Learning Objective1</label>
	        <input type="text" name="learning_objective1" class="ait-input-box" required>
	      </div>
	    </div>
	    <div class="ait-form-field-box">
              <div class="ait-form-field order-num">
                <p>2</p>
              </div>
	      <div class="ait-form-field" style="width:40%">
	      	<label style="display:none;">Objective2 Verb</label>
	        <select class="ait-input-box" name="objective2_verb" requried>
	          <option value=" ">--Select an Option--</option>
	          <option>Arrange</option>
		<option>Classify</option>
		<option>Define</option>
		<option>Describe</option>
		<option>Discuss</option>
		<option>Duplicate</option>
		<option>Explain</option>
		<option>Express</option>
		<option>Identify</option>
		<option>Indicate</option>
		<option>Label</option>
		<option>List</option>
		<option>Locate</option>
		<option>Memorize</option>
		<option>Name</option>
		<option>Order</option>
		<option>Outline</option>
		<option>Recall</option>
		<option>Recognize</option>
		<option>Relate</option>
		<option>Repeat</option>
		<option>Report</option>
		<option>Reproduce</option>
		<option>Restate</option>
		<option>Review</option>
		<option>Select</option>
		<option>State</option>
		<option>Translate</option>
	        </select>
	      </div>
	      <div class="ait-form-field">
	      	<label style="display:none;">Learning Objective2</label>
	        <input type="text" name="learning_objective2" class="ait-input-box" required>
	      </div>
	    </div>
          </div>
        </div>
        
        <div class="ait-form-field-box question-field">
          <div class="ait-form-field">
            <label>Self Assessment Questions</label>
	    <div class="ait-form-field-box">
	      <div class="ait-form-field order-num">
                <p>1</p>
              </div>
	      <div class="ait-form-field">
	      	<label style="display:none;">Self Assessment1 Question</label>
	        <input type="text" name="self_assessment1_q" class="ait-input-box" required>
	      </div>
	    </div>
	    <div style="width: 95%; margin-left: 5%;">
	      <div class="ait-form-field-box">
	        <div class="ait-form-field order-num">
                  <p>A</p>
                </div>
	        <div class="ait-form-field">
	      	  <label style="display:none;">Self Assessment1 Answer A</label>
	          <input type="text" name="self_assessment1_a1" class="ait-input-box" required>
	        </div>
	      </div>
	      <div class="ait-form-field-box">
	        <div class="ait-form-field order-num">
                  <p>B</p>
                </div>
	        <div class="ait-form-field">
	      	  <label style="display:none;">Self Assessment1 Answer B</label>
	          <input type="text" name="self_assessment1_a2" class="ait-input-box" required>
	        </div>
	      </div>
	      <div class="ait-form-field-box">
	        <div class="ait-form-field order-num">
                  <p>C</p>
                </div>
	        <div class="ait-form-field">
	      	  <label style="display:none;">Self Assessment1 Answer C</label>
	          <input type="text" name="self_assessment1_a3" class="ait-input-box" required>
	        </div>
	      </div>
	      <div class="ait-form-field-box">
	        <div class="ait-form-field order-num">
                  <p>D</p>
                </div>
	        <div class="ait-form-field">
	      	  <label style="display:none;">Self Assessment1 Answer D</label>
	          <input type="text" name="self_assessment1_a4" class="ait-input-box" required>
	        </div>
	      </div>
	    </div>
	    <div class="ait-form-field answer-radio">
              <label>Answer</label>
              <form id="answer1">
                <input type="radio" name="self_assessment1_q1_answer" class="big-radio" value="A" required>
                <label class="inline-label">A</label>
                <input type="radio" name="self_assessment1_q1_answer" class="big-radio" value="B">
                <label class="inline-label">B</label>
                <input type="radio" name="self_assessment1_q1_answer" class="big-radio" value="C">
                <label class="inline-label">C</label>
                <input type="radio" name="self_assessment1_q1_answer" class="big-radio" value="D">
                <label class="inline-label">D</label>
              </form>
            </div>
          </div>
        </div>
        <div class="ait-form-field-box question-field">
          <div class="ait-form-field">
	    <div class="ait-form-field-box">
	      <div class="ait-form-field order-num">
                <p>2</p>
              </div>
	      <div class="ait-form-field">
	      	<label style="display:none;">Self Assessment2 Question</label>
	        <input type="text" name="self_assessment2_q" class="ait-input-box" required>
	      </div>
	    </div>
	    <div style="width: 95%; margin-left: 5%;">
	      <div class="ait-form-field-box">
	        <div class="ait-form-field order-num">
                  <p>A</p>
                </div>
	        <div class="ait-form-field">
	      	  <label style="display:none;">Self Assessment2 Answer A</label>
	          <input type="text" name="self_assessment2_a1" class="ait-input-box" required>
	        </div>
	      </div>
	      <div class="ait-form-field-box">
	        <div class="ait-form-field order-num">
                  <p>B</p>
                </div>
	        <div class="ait-form-field">
	      	  <label style="display:none;">Self Assessment2 Answer B</label>
	          <input type="text" name="self_assessment2_a2" class="ait-input-box" required>
	        </div>
	      </div>
	      <div class="ait-form-field-box">
	        <div class="ait-form-field order-num">
                  <p>C</p>
                </div>
	        <div class="ait-form-field">
	      	  <label style="display:none;">Self Assessment2 Answer C</label>
	          <input type="text" name="self_assessment2_a3" class="ait-input-box" required>
	        </div>
	      </div>
	      <div class="ait-form-field-box">
	        <div class="ait-form-field order-num">
                  <p>D</p>
                </div>
	        <div class="ait-form-field">
	      	  <label style="display:none;">Self Assessment2 Answer D</label>
	          <input type="text" name="self_assessment2_a4" class="ait-input-box" required>
	        </div>
	      </div>
	    </div>
	    <div class="ait-form-field answer-radio">
              <label>Answer</label>
              <form id="answer2">
                <input type="radio" name="self_assessment2_q2_answer" class="big-radio" value="A" required>
                <label class="inline-label">A</label>
                <input type="radio" name="self_assessment2_q2_answer" class="big-radio" value="B">
                <label class="inline-label">B</label>
                <input type="radio" name="self_assessment2_q2_answer" class="big-radio" value="C">
                <label class="inline-label">C</label>
                <input type="radio" name="self_assessment2_q2_answer" class="big-radio" value="D">
                <label class="inline-label">D</label>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="ait-form-field-box" style="margin-top: 30px;">
	<div class="ait-form-field text-right">
	  <button type="submit" name="information-submit" class="ait-button f-left" onclick="step(-1);">Back</button>
	  <button type="submit" name="information-submit" class="ait-button f-right" onclick="step(1);">Submit</button>
	</div>
      </div>
    </div>
    <!-- END STEP 6 -->


	<div id="preceptor_mail_body" style="display:none">
		<div>
		<p>
As the project preceptor for a resident(s) presenting at the Great Lakes Pharmacy Resident Conference, you are required to submit a copy of your CV and conflict of interest as it pertains to your resident’s presentation. Please take a moment to complete the forms by following the below link. Your timely submission is a required component of your resident’s registration process.
		</p>
		<br><br><a href='http://glprc.bgsdev.com/conflictofinterest/'> http://glprc.bgsdev.com/conflictofinterest/ </a>
		</div>
	</div>

  </div>
</div>
<?php
}
add_shortcode( 'AIT-Abstracts', 'abstracts_frontend' );