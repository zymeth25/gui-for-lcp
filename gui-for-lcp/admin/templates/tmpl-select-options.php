<script type="text/html" id="tmpl-select-options">
  <#
    function printRelationship(name, checked) {
        const values = ['and', 'or']
        for (let i = 0; i < 2; i++) {
            let value = values[i];
            let printValue = value.toUpperCase();
            let printChecked = value === checked ? ' checked' : '';
            #>
            <label>{{printValue}}
              <input type="radio" name="{{name}}" value="{{value}}"{{{printChecked}}}>
            </label>
            <#
        }
    }

    function printSwitchCheckbox(label, name, checked) {
        const printChecked = checked ? ' checked' : '';
      #>
        <label>
          <input type="checkbox" name="{{name}}" class="lcp-swtich-checkbox"{{{printChecked}}}>
        {{label}}</label>
      <#
    }
  #>
  <div id="gflcp-select-accordion">
    <h2>Category</h2>
    <div id="gflcp-categories">
      <# printSwitchCheckbox('Categories', 'lcp-categories', true) #>
      <fieldset class="lcp-categories">
      <div>
        <h3>Current</h3>
        <label>Yes
          <input type="radio" class="lcp-categorypage" name="categorypage" value="1">
        </label>
        <label>No
          <input type="radio" class="lcp-categorypage" name="categorypage" value="0" checked>
        </label>
      </div>
      <fieldset id="lcp-cat-select">
        <div>
          <h3>Select</h3>
          <ul class="cat-checklist category-checklist">
            {{{data.categories}}}
          </ul>
        </div>
        <div>
          <h3>Exclude</h3>
          <ul class="cat-checklist excategory-checklist">
            {{{data.categories}}}
          </ul>
        </div>
        <div>
          <h3>Relationship</h3>
          <# printRelationship('catrel', 'and'); #>
        </div>
      </fieldset>
      <div>
        <h3>Child categories</h3>
        <label>Include
          <input type="radio" name="child-cat" value="1" checked>
        </label>
        <label>Exclude
          <input type="radio" name="child-cat" value="0">
        </label>
      </div>
      </fieldset>
    </div>
    <h2>Author</h2>
    <div id="gflcp-author">
      <# printSwitchCheckbox('Author', 'lcp-author', false) #>
      <fieldset class="lcp-author" disabled>
        <div>
          <select id="lcp-author" name="author">
            <# _.each(data.users, function(user) { #>
              <option value="{{user.user_nicename}}">{{user.display_name}}</option>;
            <# }); #>
          </select>
        </div>
      </fieldset>
    </div>
    <h2>Tags</h2>
    <div id="gflcp-tags">
      <# printSwitchCheckbox('Tags', 'lcp-tags', false) #>
      <fieldset class="lcp-tags" disabled>
        <div>
          <h3>Current</h3>
          <label>Yes
            <input type="radio" class="lcp-currenttags" name="currenttags" value="1">
          </label>
          <label>No
            <input type="radio" class="lcp-currenttags" name="currenttags" value="0" checked>
          </label>
        </div>
        <fieldset id="lcp-tag-select">
          <div>
            <h3>Select</h3>
            <ul class="tag-checklist cat-checklist">
              {{{data.tags}}}
            </ul>
          </div>
          <div id="lcp-tags-exclude">
            <h3>Exclude</h3>
            <ul class="extag-checklist cat-checklist">
              {{{data.tags}}}
            </ul>
          </div>
          <div>
            <h3>Relationship</h3>
            <# printRelationship('tagrel', 'and'); #>
          </div>
        </fieldset>
      </fieldset>
    </div>
    <h2>Custom taxonomies</h2>
    <div id="gflcp-taxonomies">
      <# printSwitchCheckbox('Custom taxonomies', 'lcp-taxonomies', false) #>
      <fieldset class="lcp-taxonomies" disabled>
        <div>
          <h3>Choose one or more taxonomies</h3>
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
        </div>
        <button type="button" id="load-terms" class="button">Load taxonomy terms</button>
        <div class="taxonomy-terms"></div>
        <div>
          <h3>Relationship</h3>
          <# printRelationship('taxrel', 'and'); #>
        </div>
      </fieldset>
    </div>
    <h2>Starting with</h2>
    <div id="gflcp-starting-with">
      <# printSwitchCheckbox('Starting with', 'lcp-starting-with', false) #>
      <fieldset class="lcp-starting-with" disabled>
        <div>
          <label>Comma separated characters
            <input
              type="text"
              name="starting-with"
              title="comma separated single characters"
              pattern="[^,](,[^,])*"
            >
          </label>
        </div>
      </fieldset>
    </div>
    <h2>Date</h2>
    <div id="gflcp-date">
      <# printSwitchCheckbox('Date', 'lcp-date', false) #>
      <fieldset class="lcp-date" disabled>
        <div>
          <label>Year
            <input name="year" type="number" min="1900" max="3000">
          </label>
          <label>Month
            <input name="month" type="number" min="1" max="12">
          </label>
        </div>
        <div>
          <h3>Range</h3>
          <label>After
            <input type="text" name="after" class="lcp-datepicker">
          </label>
          <label>Before
            <input type="text" name="before" class="lcp-datepicker">
          </label>
        </div>
      </fieldset>
    </div>
    <h2>Search</h2>
    <div id="gflcp-search">
      <# printSwitchCheckbox('Search', 'lcp-search', false) #>
      <fieldset class="lcp-search" disabled>
        <div>
          <label>Search terms
            <input type="text" name="search">
          </label>
        </div>
      </fieldset>
    </div>
    <h2>Exclude posts</h2>
    <div id="gflcp-exclude-posts">
      <# printSwitchCheckbox('Exclude posts', 'lcp-exclude-posts', false) #>
      <fieldset class="lcp-exclude-posts" disabled>
        <div>
          <h3>Current</h3>
          <label>Yes
            <input type="radio" name="excurpost" value="1">
          </label>
          <label>No
            <input type="radio" name="excurpost" value="0" checked>
          </label>
        </div>
        <div>
          <h3>List</h3>
          <label>Post IDs, comma separated
            <input type="text" name="expost" pattern="\d+(,\d)*" title="comma separated post IDs">
          </label>
        </div>
      </fieldset>
    </div>
    <h2>Offset</h2>
    <div id="gflcp-offset">
      <# printSwitchCheckbox('Offset', 'lcp-offset', false) #>
      <fieldset class="lcp-offset" disabled>
        <div>
          <label>Offset value
            <input type="number" name="offset" min="0">
          </label>
        </div>
      </fieldset>
    </div>
    <h2>Post type</h2>
    <div id="gflcp-post-types">
      <fieldset class="lcp-post-types">
        <div>
          <label>Default - 'post'
            <input type="radio" name="pt-mode" value="default" checked>
          </label>
          <label>Any
            <input type="radio" name="pt-mode" value="any">
          </label>
          <label>Select
            <input type="radio" name="pt-mode" value="select">
          </label>
        </div>
        <fieldset id="lcp-pt-select" disabled>
          <h3>Select</h3>
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
      </fieldset>
    </div>
    <h2>Post status</h2>
    <div id="gflcp-post-status">
      <fieldset class="lcp-post-status">
        <div>
          <label>Default - 'publish'
            <input type="radio" name="ps-mode" value="default" checked>
          </label>
          <label>Any
            <input type="radio" name="ps-mode" value="any">
          </label>
          <label>Select
            <input type="radio" name="ps-mode" value="select">
          </label>
        </div>
        <fieldset id="lcp-ps-select" disabled>
        <ul class="cat-checklist ps-checklist">
          <#
            const statuses = ['publish', 'pending', 'draft', 'auto-draft',
                              'future', 'private', 'inherit', 'trash'];
            _.each(statuses, function(status, key) {
              let checked = key === 0 ? ' checked' : '';
          #>
            <li><label>
              <input type="checkbox" name="post-status" value="{{status}}"{{checked}}>
              {{status}}
            </label></li>
          <# }); #>
        </ul>
        </fieldset>
      </fieldset>
    </div>
    <h2>Show protected</h2>
    <div id="gflcp-show-protected">
      <fieldset class="lcp-show-protected">
        <div>
          <label>Yes
            <input type="radio" name="show-protected" value="1">
          </label>
          <label>No
            <input type="radio" name="show-protected" value="0" checked>
          </label>
        </div>
      </fieldset>
    </div>
    <h2>Parent post</h2>
    <div id="gflcp-parent-post">
      <# printSwitchCheckbox('Parent post', 'lcp-parent-post', false) #>
      <fieldset class="lcp-parent-post" disabled>
        <div>
          <label>Disply only children of this parent post
            <input type="number" name="parent-post" min="0">
          </label>
        </div>
      </fieldset>
    </div>
    <h2>Custom fields</h2>
    <div id="gflcp-custom-fields">
      <# printSwitchCheckbox('Custom fields', 'lcp-custom-fields', false) #>
      <fieldset class="lcp-custom-fields" disabled>
        <div>
          <label>Customfield name
            <input type="text" name="customfield-name" required>
          </label>
          <label>Customfield value
            <input type="text" name="customfield-value" required>
          </label>
        </div>
      </fieldset>
    </div>
  </div>
</script>
