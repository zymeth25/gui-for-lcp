<?php
/**
 * GUI for LCP: Select options template.
 *
 * Used by SelectOptionsSubview.js.
 *
 * @author     Klemens Starybrat
 *
 * @package gui_for_lcp\admin\templates
 * @since 1.0.0
 */

?>
<script type="text/html" id="tmpl-select-options">
  <#
    function printRelationship(name, checked) {
        var values = {
            and: '<?php esc_html_e( 'AND', 'gui-for-lcp' ); ?>',
            or:  '<?php esc_html_e( 'OR', 'gui-for-lcp' ); ?>'
        };
        #>
        <ul>
        <#
        _.each(values, (label, value) => {
            var printChecked = value === checked ? ' checked' : '';
            #>
            <li>
              <label>
                <input type="radio" name="{{name}}" value="{{value}}"{{{printChecked}}}>
                {{label}}
              </label>
            </li>
            <#
        });
        #>
        </ul>
        <#
    }

    function printSwitchCheckbox(name, checked) {
        var printChecked = checked ? ' checked' : '';
      #>
        <div class="gflcp-switch-block">
          <label>
            <input type="checkbox" name="{{name}}" class="gflcp-swtich-checkbox"{{{printChecked}}}>
            <span class="gflcp-slider"></span>
            <span class="gflcp-switch-label"><?php esc_html_e( 'Enable', 'gui-for-lcp' ); ?></span>
          </label>
        </div>
      <#
    }
  #>
  <div id="gflcp-select-accordion">
    <h2><?php esc_html_e( 'Category', 'gui-for-lcp' ); ?></h2>
    <div>
      <# printSwitchCheckbox('gflcp-categories', true) #>
      <fieldset class="gflcp-categories">
        <div class="gflcp-vmargin-10">
          <label>
            <input type="checkbox" class="gflcp-categorypage" name="categorypage">
            <?php esc_html_e( 'Current category', 'gui-for-lcp' ); ?>
          </label>
        </div>
        <div id="gflcp-cat-grid">
          <fieldset class="gflcp-cat-select">
            <legend><?php esc_html_e( 'Select', 'gui-for-lcp' ); ?></legend>
            <ul class="cat-checklist category-checklist">
              {{{data.categories}}}
            </ul>
          </fieldset>
          <fieldset class="gflcp-cat-select">
            <legend><?php esc_html_e( 'Exclude', 'gui-for-lcp' ); ?></legend>
            <ul class="cat-checklist excategory-checklist">
              {{{data.categories}}}
            </ul>
          </fieldset>
          <fieldset class="gflcp-cat-select">
            <legend><?php esc_html_e( 'Relationship', 'gui-for-lcp' ); ?></legend>
            <# printRelationship('catrel', 'and'); #>
          </fieldset>
          <fieldset>
            <legend><?php esc_html_e( 'Child categories', 'gui-for-lcp' ); ?></legend>
            <ul>
              <li>
                <label>
                  <input type="radio" name="child-cat" value="1" checked>
                  <?php esc_html_e( 'Include', 'gui-for-lcp' ); ?>
                </label>
              </li>
              <li>
                <label>
                  <input type="radio" name="child-cat" value="0">
                  <?php esc_html_e( 'Exclude', 'gui-for-lcp' ); ?>
                </label>
              </li>
            </ul>
          </fieldset>
        </div>
      </fieldset>
    </div>
    <h2><?php esc_html_e( 'Tags', 'gui-for-lcp' ); ?></h2>
    <div>
      <# printSwitchCheckbox('gflcp-tags', false) #>
      <fieldset class="gflcp-tags" disabled>
        <div class="gflcp-vmargin-10">
          <label>
            <input type="checkbox" class="gflcp-currenttags" name="currenttags">
            <?php esc_html_e( 'Current tags', 'gui-for-lcp' ); ?>
          </label>
        </div>
        <div id="gflcp-tag-grid">
          <fieldset class="gflcp-tag-select">
            <legend><?php esc_html_e( 'Select', 'gui-for-lcp' ); ?></legend>
            <ul class="tag-checklist cat-checklist">
              {{{data.tags}}}
            </ul>
          </fieldset>
          <fieldset class="gflcp-tag-select">
            <legend><?php esc_html_e( 'Exclude', 'gui-for-lcp' ); ?></legend>
            <ul class="extag-checklist cat-checklist">
              {{{data.tags}}}
            </ul>
          </fieldset>
          <fieldset class="gflcp-tag-select">
            <legend><?php esc_html_e( 'Relationship', 'gui-for-lcp' ); ?></legend>
            <# printRelationship('tagrel', 'and'); #>
          </fieldset>
        </div>
      </fieldset>
    </div>
    <h2><?php esc_html_e( 'Custom taxonomies', 'gui-for-lcp' ); ?></h2>
    <div>
      <# printSwitchCheckbox('gflcp-taxonomies', false) #>
      <fieldset class="gflcp-taxonomies" disabled>
        <div id="gflcp-tax-grid">
          <fieldset>
            <legend><?php esc_html_e( 'Choose one or more taxonomies', 'gui-for-lcp' ); ?></legend>
            <ul class="cat-checklist tax-checklist">
              <# _.each(data.taxonomies, function(tax) { #>
                <li>
                  <label>
                    <input type="checkbox" name="taxonomy" value="{{tax.slug}}">
                    {{tax.name}}
                  </label>
                </li>
              <# }); #>
            </ul>
          </fieldset>
          <fieldset>
            <legend><?php esc_html_e( 'Relationship', 'gui-for-lcp' ); ?></legend>
            <# printRelationship('taxrel', 'and'); #>
          </fieldset>
          <button type="button" id="load-terms" class="button">
            <?php esc_html_e( 'Load taxonomy terms', 'gui-for-lcp' ); ?>
          </button>
        </div>
        <div id="gflcp-taxonomy-terms"></div>
      </fieldset>
    </div>
    <h2><?php esc_html_e( 'Post type & status', 'gui-for-lcp' ); ?></h2>
    <div class="gflcp-type-status">
      <section class="gflcp-post-types">
        <h3>Post type</h3>
        <fieldset class="gflcp-vmargin-10">
          <legend>Mode</legend>
          <ul>
            <li>
              <label>
                <input type="radio" name="pt-mode" value="default" checked>
                <?php esc_html_e( 'Default', 'gui-for-lcp' ); ?> - 'post'
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="pt-mode" value="any">
                <?php esc_html_e( 'Any', 'gui-for-lcp' ); ?>
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="pt-mode" value="select">
                <?php esc_html_e( 'Select', 'gui-for-lcp' ); ?>
              </label>
            </li>
          </ul>
        </fieldset>
        <fieldset id="gflcp-pt-select" disabled>
          <legend><?php esc_html_e( 'Post types', 'gui-for-lcp' ); ?></legend>
          <ul class="cat-checklist pt-checklist">
            <# _.each(data.post_types, function(pt) { #>
              <li>
                <label>
                  <input type="checkbox" name="post-type" value="{{pt.name}}">
                  {{pt.labels.name}}
                </label>
              </li>
            <# }); #>
          </ul>
        </fieldset>
      </section>
      <section class="gflcp-post-status">
        <h3>Post status</h3>
        <fieldset class="gflcp-vmargin-10">
          <legend>Mode</legend>
          <ul>
            <li>
              <label>
                <input type="radio" name="ps-mode" value="default" checked>
                <?php esc_html_e( 'Default', 'gui-for-lcp' ); ?> - 'publish'
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="ps-mode" value="any">
                <?php esc_html_e( 'Any', 'gui-for-lcp' ); ?>
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="ps-mode" value="select">
                <?php esc_html_e( 'Select', 'gui-for-lcp' ); ?>
              </label>
            </li>
          </ul>
        </fieldset>
        <fieldset id="gflcp-ps-select" disabled>
          <legend><?php esc_html_e( 'Post statuses', 'gui-for-lcp' ); ?></legend>
          <ul class="cat-checklist ps-checklist">
            <#
              var statuses = ['publish', 'pending', 'draft', 'auto-draft',
                                'future', 'private', 'inherit', 'trash'];
              _.each(statuses, function(status, key) {
                var checked = key === 0 ? ' checked' : '';
            #>
              <li><label>
                <input type="checkbox" name="post-status" value="{{status}}"{{checked}}>
                {{status}}
              </label></li>
            <# }); #>
          </ul>
        </fieldset>
      </section>
      <label>
        <input type="checkbox" name="show-protected">
        Include password protected posts
      </label>
    </div>
    <h2><?php esc_html_e( 'Custom fields', 'gui-for-lcp' ); ?></h2>
    <div>
      <# printSwitchCheckbox('gflcp-custom-fields', false) #>
      <fieldset class="gflcp-custom-fields" disabled>
        <div>
          <label><?php esc_html_e( 'Customfield name', 'gui-for-lcp' ); ?>
            <input type="text" name="customfield-name" required>
          </label>
        </div>
        <div>
          <label><?php esc_html_e( 'Customfield value', 'gui-for-lcp' ); ?>
            <input type="text" name="customfield-value" required>
          </label>
        </div>
      </fieldset>
    </div>
    <h2><?php esc_html_e( 'Exclude posts', 'gui-for-lcp' ); ?></h2>
    <div>
      <# printSwitchCheckbox('gflcp-exclude-posts', false) #>
      <fieldset class="gflcp-exclude-posts" disabled>
        <div class="gflcp-vmargin-10">
          <label>
            <input type="checkbox" name="excurpost">
            <?php esc_html_e( 'Exclude current post', 'gui-for-lcp' ); ?>
          </label>
        </div>
        <div>
          <label><?php esc_html_e( 'Post IDs, comma separated', 'gui-for-lcp' ); ?>
            <input
              type="text"
              name="expost"
              pattern="\d+(,\d)*"
              title="<?php esc_attr_e( 'Post IDs, comma separated', 'gui-for-lcp' ); ?>">
          </label>
        </div>
      </fieldset>
    </div>
    <h2><?php esc_html_e( 'Author', 'gui-for-lcp' ); ?></h2>
    <div>
      <# printSwitchCheckbox('gflcp-author', false) #>
      <fieldset class="gflcp-author" disabled>
        <div>
          <select id="gflcp-author" name="author">
            <# _.each(data.users, function(user) { #>
              <option value="{{user.user_nicename}}">{{user.display_name}}</option>
            <# }); #>
          </select>
        </div>
      </fieldset>
    </div>
    <h2><?php esc_html_e( 'Date', 'gui-for-lcp' ); ?></h2>
    <div>
      <# printSwitchCheckbox('gflcp-date', false) #>
      <fieldset class="gflcp-date" disabled>
        <fieldset>
          <legend>Date</legend>
          <label><?php esc_html_e( 'Year', 'gui-for-lcp' ); ?>
            <input name="year" type="number" min="1900" max="3000">
          </label>
          <label><?php esc_html_e( 'Month', 'gui-for-lcp' ); ?>
            <input name="month" type="number" min="1" max="12">
          </label>
        </fieldset>
        <fieldset>
          <legend>Date range</legend>
          <label><?php esc_html_e( 'After', 'gui-for-lcp' ); ?>
            <input type="text" name="after" class="gflcp-datepicker">
          </label>
          <label><?php esc_html_e( 'Before', 'gui-for-lcp' ); ?>
            <input type="text" name="before" class="gflcp-datepicker">
          </label>
        </fieldset>
      </fieldset>
    </div>
    <h2><?php esc_html_e( 'Search', 'gui-for-lcp' ); ?></h2>
    <div>
      <# printSwitchCheckbox('gflcp-search', false) #>
      <fieldset class="gflcp-search" disabled>
        <div>
          <label><?php esc_html_e( 'Search terms', 'gui-for-lcp' ); ?>
            <input type="text" name="search">
          </label>
        </div>
      </fieldset>
    </div>
    <h2><?php esc_html_e( 'Post title first character', 'gui-for-lcp' ); ?></h2>
    <div>
      <# printSwitchCheckbox('gflcp-starting-with', false) #>
      <fieldset class="gflcp-starting-with" disabled>
        <div>
          <label><?php esc_html_e( 'Comma separated single characters', 'gui-for-lcp' ); ?>
            <input
              type="text"
              name="starting-with"
              title="<?php esc_attr_e( 'comma separated single characters', 'gui-for-lcp' ); ?>"
              pattern="[^,](,[^,])*"
            >
          </label>
        </div>
      </fieldset>
    </div>
    <h2><?php esc_html_e( 'Offset', 'gui-for-lcp' ); ?></h2>
    <div>
      <# printSwitchCheckbox('gflcp-offset', false) #>
      <fieldset class="gflcp-offset" disabled>
        <div>
          <label><?php esc_html_e( 'Offset value', 'gui-for-lcp' ); ?>
            <input type="number" name="offset" min="0">
          </label>
        </div>
      </fieldset>
    </div>
    <h2><?php esc_html_e( 'Parent post', 'gui-for-lcp' ); ?></h2>
    <div>
      <# printSwitchCheckbox('gflcp-parent-post', false) #>
      <fieldset class="gflcp-parent-post" disabled>
        <div>
          <label><?php esc_html_e( 'Disply only children of this post ID', 'gui-for-lcp' ); ?>
            <input type="number" name="parent-post" min="0">
          </label>
        </div>
      </fieldset>
    </div>
  </div>
</script>
