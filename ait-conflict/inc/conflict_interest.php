<?php

function conflict_interest( $atts ){
	?>
<div class="ait-container">

  <div class="ait-step-main-box">
    
      <div class="ait-information" id="login_part">
        <div class="ait-already-box no-border no-padding" style="margin-bottom:80px;">
          <div class="ait-already-form">
            <form id="presentation_form" class="ait-form" action="" method="post">
              <div class="ait-form-field-box">
                <div class="ait-form-field">
                  <label>Enter your Email Address and click "Login"</label>
                  <input type="email" class="ait-input-box" style="width:30%" id="presentation_email" required>
                  <button type="submit" class="ait-button" onclick="event.preventDefault(); retrive_presentation_conflict()"
                    style="width: 112px; padding: 20px 16px;">Login</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
    <div id="conflict_part">
    <!-- START CONFLICT -->
    <div>
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
      
    
    <div style="margin-top:40px;">
      <div class="ait-information">
        <div class="no-border no-padding">
          <h3 class="ait-title">CV Upload</h3>
          <div class="ait-description">
            <p>Please click "add my CV" to open a window that will allow you to browse your drives for your CV. Select your CV and click "Open". Verify the correct file was selected then click "Upload".</p>
            <p><b>Current CV</b> - Note: Some browsers willl change a file extension of .docx to .zip when the file is downloaded. In this casse you must save the file to your hard drive and change the extension from .zip to .docx before opening.</p>
          </div>
        </div>
      </div>
      <div class="ait-information-form">
        <div class="ait-form-field-box">
	  <div class="ait-form-field text-right">
	    <form enctype="multipart/form-data">
	    <input type="file" name="file" id="prec_cv_file" style="display:none;" onchange=upload_confl()>
	    <button type="button" class="ait-button add-cv-btn" style="background-color:#a76503 !important;" onclick="document.getElementById('prec_cv_file').click()"> + Add my CV</button>
	    </form>
	  </div>
        </div>
      </div>
      <div class="ait-form-field-box">
	<div class="ait-form-field text-right">
	  <button type="submit" name="information-submit" class="ait-button f-left">Back</button>
	  <button type="submit" name="information-submit" class="ait-button f-right" onclick="submitData();">Next</button>
	</div>
      </div>
    </div>
    <!-- END CONFLICT -->
    </div>

  </div>
</div>
<?php
}
add_shortcode( 'AIT-Conflict-Of-Interest', 'conflict_interest' );