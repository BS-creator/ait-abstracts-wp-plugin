<?php

function presentation_upload( $atts ){
	?>
	
	
<div class="protect-presentation"></div>
	
<div class="ait-container">

  <div class="ait-step-main-box">

    <!-- START PRESENTATION UPLOAD -->
    <div class=" presentation-upload">
      <div class="ait-information">
        <div class="no-border no-padding">
          <h3 class="ait-title">Presentation Upload</h3>
        </div>
      </div>
      <div class="ait-information">
        <div class="ait-already-box no-border no-padding" style="margin-bottom:80px;">
          <div class="ait-already-form">
            <form id="presentation_form" class="ait-form" action="" method="post">
              <div class="ait-form-field-box">
                <div class="ait-form-field">
                  <label>Enter your Email Address and click "Login"</label>
                  <input type="email" class="ait-input-box" style="width:30%" id="presentation_email" required>
                  <button type="submit" class="ait-button" onclick="event.preventDefault(); retrive_presentation()"
                    style="width: 112px; padding: 20px 16px;">Login</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="ait-description present-section">
        <p>Resident: <b id="presentation_resident"></b><br />
          Abstract Title: <b id="presentation_title"></b><br />
          <a style="cursor:pointer;color:#2196F3;" onclick="view_abstract()">View Abstract</a><br />
          <a id="presentation_dl" style="cursor:pointer;color:#2196F3;" href="http://glprc.bgsdev.com/wp-content/uploads/abstraction_files/presentation/presentation (w w).pptx" download>View Presentation</a>
          <span style="color: #FF5722;">(The name of the uploaded file will be different than the original. A unique
            identifier has been added to the end to guarantee a unique file name. If you re-upload your presentation,
            please use the original name.)</span>
        </p>
        <p>Please verify your presentation meets these requirements then continue with your upload.</p>
        <ul>
          <li>Maximum file size: 20Meg</li>
          <li>Allowed file types: ppt, pptx</li>
          <li>Presentation file name uses the format: Last name, first name.ppt (or .pptx)</li>
        </ul>
        <p>Click "Select File" below to open a browse window. Select your presentation then click the "Open" button in
          the
          bottom right hand corner. The upload will begin automatically. Do not navigate away from this page until the
          upload is complete.</p>
        <p>You may upload an updated presentation. Please be sure to name it the same as the original so the original
          will
          be replaced.</p>
      </div>
      <div class="ait-information-form present-section">
        <div class="ait-form-field-box">
          <div class="ait-form-field text-right">
            <form enctype="multipart/form-data">
              <input type="file" name="file" id="pres_file" style="display:none;" onchange=upload_pres()>
              <button type="button" class="ait-button add-cv-btn" style="background-color:#a76503 !important;"
                onclick="document.getElementById('pres_file').click()"> + Upload Presentation</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END PRESENTATION UPLOAD -->

    <!-- START VIEW ABSTRACT -->
    <div class=" presentation-upload" style="display:none;">
      <div class="ait-information">
        <div class="no-border no-padding">
          <h3 class="ait-title"> <span class="back-to-upload" onclick="view_abstract()">
              <span class="back-to-upload"> < </span> View Of Abstract</h3>
          <div class="ait-description presentation_view">
            <div class="view-abs-section">
              <label>Practice Area</label>
              <p forkey="practice_area"></p>
            </div>
            <div class="view-abs-section">
              <label>ACPE Topic</label>
              <p forkey="acpe_topic"></p>
            </div>
            <div class="view-abs-section">
              <label>Title</label>
              <p forkey="title"></p>
            </div>
            <div class="view-abs-section">
              <label>Authors</label>
              <p forkey="authors"></p>
            </div>
            <div class="view-abs-section">
              <label>Abstract</label>
              <p forkey="abstract"></p>
            </div>
            <div class="view-abs-section">
              <label>Learning Objective1</label>
              <p><span forkey="objective1_verb"></span>: <span forkey="learning_objective1"></span></p>
            </div>
            <div class="view-abs-section">
              <label>Learning Objective2</label>
              <p><span forkey="objective2_verb"></span>: <span forkey="learning_objective2"></span></p>
            </div>
            <div class="view-abs-section">
              <label>Self Assessment Question 1</label>
              <p forkey="self_assessment1_q"></p>
              <p><b>A</b>. <span forkey="self_assessment1_a1"></span></p>
              <p><b>B</b>. <span forkey="self_assessment1_a2"></span></p>
              <p><b>C</b>. <span forkey="self_assessment1_a3"></span></p>
              <p><b>D</b>. <span forkey="self_assessment1_a4"></span></p>
              <p>&nbsp;&nbsp; <b>Answer: </b> <span forkey="self_assessment1_q1_answer"></span></p>
            </div>
            <div class="view-abs-section">
              <label>Self Assessment Question 2</label>
              <p forkey="self_assessment2_q"></p>
              <p><b>A</b>. <span forkey="self_assessment2_a1"></span></p>
              <p><b>B</b>. <span forkey="self_assessment2_a2"></span></p>
              <p><b>C</b>. <span forkey="self_assessment2_a3"></span></p>
              <p><b>D</b>. <span forkey="self_assessment2_a4"></span></p>
              <p>&nbsp;&nbsp; <b>Answer: </b> <span forkey="self_assessment2_q2_answer"></span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END VIEW ABSTRACT -->

  </div>
</div>
<?php
}
add_shortcode( 'AIT-Presentation-Upload', 'presentation_upload' );