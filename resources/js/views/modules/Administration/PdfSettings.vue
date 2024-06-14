<template>
  <main>
    <breadcrumbs></breadcrumbs>
    <div class="container-fluid">
      <form @submit.prevent="savePdfSetting" enctype="multipart/form-data">
        <vue-element-loading :active="loading" />
        <div class="card mb-2">
          <div class="card-header">
            <h3>{{ lang.LBL_PAGE_SETTINGS }}</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_PAGE_FORMAT }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_page_format" v-model="pdf.pdf_page_format" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                Supported formats include 4A0, 2A0, A0, A1, A2, A3,<b>
                  A4 (default)</b>, A5, A6, A7, B0, B1, B2, B3, B4, B5, B6, B7, C0, C1, C2, C3,
                C4, C5, C6, C7, RA0, RA1, RA2, RA3, RA4, SRA0, SRA1, SRA2, SRA3,
                SRA4, LETTER, LEGAL, EXECUTIVE, FOLIO.
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_PAGE_ORIENTATION }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_page_orientation"
                  v-model="pdf.pdf_page_orientation" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                Possible values are (case insensitive):
                <b>P or Portrait (default)</b>, L or Landscape
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-2">
          <div class="card-header">
            <h3>{{ lang.LBL_HEADER_SETTING }}</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_HEADER_TITLE }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_header_title" v-model="pdf.pdf_header_title" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                The title of header. <b>Firm / Company name</b> is the default value
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_HEADER_SUBTITLE }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_header_subtitle"
                  v-model="pdf.pdf_header_subtitle" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                The subtitle of header
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_HEADER_LINE_2 }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_header_string" v-model="pdf.pdf_header_string" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                The content to be displayed after header title.
                <b>Firm / Company address</b> is the default value
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_HEADER_LINE_3 }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_header_string_two"
                  v-model="pdf.pdf_header_string_two" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12"></div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_HEADER_LINE_4 }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_header_string_three"
                  v-model="pdf.pdf_header_string_three" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12"></div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_HEADER_LINE_5 }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_header_string_five"
                  v-model="pdf.pdf_header_string_five" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12"></div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_TITLE_QUOTE }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_header_string_four"
                  v-model="pdf.pdf_header_string_four" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12"></div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_DOCUMENT_NUMBER }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_header_string_six"
                  v-model="pdf.pdf_header_string_six" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12"></div>
            </div>
          </div>
        </div>
        <div class="card mb-2">
          <div class="card-header">
            <h3>{{ lang.LBL_PAGE_MARGINS }}</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_HEADER_MARGIN }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_margin_header" v-model="pdf.pdf_margin_header" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                The margin before the Header starts.
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_FOOTER_MARGIN }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_margin_footer" v-model="pdf.pdf_margin_footer" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                The margin after the Footer
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_TOP_MARGIN }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_margin_top" v-model="pdf.pdf_margin_top" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                The margin between the the top of page and printing of data
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_BOTTOM_MARGIN }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_margin_bottom" v-model="pdf.pdf_margin_bottom" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                The margin between the the end of data and page end
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_LEFT_MARGIN }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_margin_left" v-model="pdf.pdf_margin_left" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                The margin on left on every page
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_RIGHT_MARGIN }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_margin_right" v-model="pdf.pdf_margin_right" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                The margin on right on every page
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-2">
          <div class="card-header">
            <h3>
              {{ lang.LBL_FONT_SETTINGS }}
              <small>Supported font-families (case insensitive) : times,
                <b>helvetica (default)</b>, courier</small>
            </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_HEADER_FONT_FAMILY }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_font_name_main" v-model="pdf.pdf_font_name_main" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                Font style / family for header
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_HEADER_FONT_FAMILY_SIZE }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_font_size_main" v-model="pdf.pdf_font_size_main" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                Font size of header
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_DATA_FONT_FAMILY }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_font_name_data" v-model="pdf.pdf_font_name_data" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                Font style / family for data
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_DATA_FONT_FAMILY_SIZE }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_font_size_data" v-model="pdf.pdf_font_size_data" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                Font size of data
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-2">
          <div class="card-header">
            <h3>
              {{ lang.LBL_PDF_LOGO_SETTING }}
              <small>Supported file types (case insensitive) : <b>jpg (default)</b>,
                jpeg</small>
            </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_UPLOAD_LOGO }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="file" class="form-control" @change="previewFile($event,'upload_logo')" />
                <div class="w-100 mt-2">
                  <img :src="upload_logo_previewImg" v-if="upload_logo_previewImg" class="prev_img" />
                  <img v-else-if="pdf.upload_logo" :src="'/uploads/pdf_setting/'+pdf.upload_logo" class="prev_img" />
                </div>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_UPLOAD_NABH_LOGO }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="file" class="form-control" @change="previewFile($event,'upload_nabh_logo')" />
                <div class="w-100 mt-2">
                  <img :src="upload_nabh_logo_previewImg" v-if="upload_nabh_logo_previewImg" class="prev_img" />
                  <img v-else-if="pdf.upload_nabh_logo" :src="'/uploads/pdf_setting/'+pdf.upload_nabh_logo"
                    class="prev_img" />
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_PDF_LOGO_WIDTH }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_header_logo_custom_width"
                  v-model="pdf.pdf_header_logo_custom_width" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                in Px (Pixels), <b>150 px (default)</b>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_PDF_LOGO_HEIGHT }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="text" class="form-control mb-1" id="pdf_header_logo_custom_height"
                  v-model="pdf.pdf_header_logo_custom_height" />
              </div>
              <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                in Px (Pixels), <b>150 px (default)</b>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-2">
          <div class="card-header">
            <h3>{{ lang.LBL_LOGIN_PAGE }}</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_LOGIN_LOGO_IMAGE }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="file" class="form-control" @change="previewFile($event,'upload_login_logo')" />
                <div class="w-100 mt-2">
                  <img :src="upload_login_logo_previewImg" v-if="upload_login_logo_previewImg" class="prev_img" />
                  <img v-else-if="pdf.upload_login_logo" :src="'/uploads/pdf_setting/'+pdf.upload_login_logo"
                    class="prev_img" />
                </div>
                <b>Image Size >= 1300 px X 700 px (Pixels)</b>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label>{{ lang.LBL_LOGIN_BACKGROUND_IMAGE }}</label>
              </div>
              <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <input type="file" class="form-control" @change="previewFile($event,'upload_login_background')" />
                <div class="w-100 mt-2">
                  <img :src="login_background_previewImg" v-if="login_background_previewImg" class="prev_img" />
                  <img v-else-if="pdf.upload_login_background"
                    :src="'/uploads/pdf_setting/'+pdf.upload_login_background" class="prev_img" />
                </div>
                <b>Image Size >= 1300 px X 700 px (Pixels)</b>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-2">
          <div class="card-body p-2 text-end">
            <button type="submit" class="btn btn-success btn-sm">Save</button>
            <button type="submit" class="btn btn-secondary btn-sm">Restore</button>
            <button type="submit" class="btn btn-warning btn-sm">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </main>
</template>
<script src="@/views/modules/Administration/js/PdfSettings.js"></script>