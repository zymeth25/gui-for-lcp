function lcpGetCategories(FD) {
    if (!FD.has('lcp-categories')) return [];

    const catRel = (FD.has('catrel')) ? (FD.get('catrel')) : null;

    let output= [];
    let ids;
    let categories;
    let exCategories;
    let childCat = (FD.has('child-cat')) ? (FD.get('child-cat')) : null;

    if ('0' === childCat) {
        output.push('child_categories="false"');
    }

    if (FD.has('categorypage') && '1' === FD.get('categorypage')) {
        output.push('categorypage="yes"');
        return output;
    }

    categories = (FD.has('cat')) ? (FD.getAll('cat')) : [];
    exCategories = (FD.has('excat')) ? (FD.getAll('excat')): [];
    exCategories = _.map(exCategories, function(val) {return '-' + val;});

    if ('or' === catRel) {
        ids = categories.concat(exCategories).join(',');
    } else if ('and' === catRel) {
        const exCatSeparator = (_.isEmpty(categories)) ? ',' : '';

        categories = categories.join('+');
        exCategories = exCategories.join(exCatSeparator);
        ids = categories + exCategories;
    }
    if (!_.isEmpty(ids)) {
        output.push(`id="${ids}"`);
        return output;
    } else return [];
}

function lcpGetTags(FD) {
    if (!FD.has('lcp-tags')) return [];

    const tagRel = (FD.has('tagrel')) ? (FD.get('tagrel')) : null;

    let output= [];
    let tags;
    let exTags;

    if (FD.has('currenttags') && '1' === FD.get('currenttags')) {
        return ['currenttags="yes"'];
    }

    tags = (FD.has('tag')) ? (FD.getAll('tag')) : [];
    exTags = (FD.has('extag')) ? (FD.getAll('extag')): [];

    if ('or' === tagRel) {
        tags = tags.join(',');
    } else if ('and' === tagRel) {
        tags = tags.join('+');
    }

    if (!_.isEmpty(tags)) output.push(`tags="${tags}"`);
    if (!_.isEmpty(exTags)) output.push(`exclude_tags="${exTags.join(',')}"`);

    if (!_.isEmpty(output)) {
        return output;
    } else return [];
}

function lcpGetAuthor(FD) {
    if (!FD.has('author')) return [];

    const author = FD.get('author');
    if ( ! _.isEmpty( author ) ) {
        return [`author_posts="${author}"`];
    } else return [];
}

function lcpGetCustomTaxonomies(FD) {
    if (!FD.has('lcp-taxonomies') || !FD.has('taxonomy') || !FD.has('taxrel')) {
        return [];
    }
    const taxonomies = FD.getAll('taxonomy');
    const taxRel = FD.get('taxrel');

    let taxonomy;
    let singleTaxTerms;
    let output = [];

    if (1 === taxonomies.length) {
        const separator = ( 'and' === taxRel) ? ('+') : (',');

        taxonomy = taxonomies[0];
        singleTaxTerms = (FD.has(`${taxonomy}-term`)) ? (FD.getAll(`${taxonomy}-term`)) : null;

        if (_.isArray(singleTaxTerms)) {
            output.push(`taxonomy="${taxonomy}" terms="${singleTaxTerms.join(separator)}"`);
        }
    } else if (taxonomies.length > 1) {
        let taxonomyQueries = [];
        _.each(taxonomies, function(taxonomy) {
            singleTaxTerms = (FD.has(`${taxonomy}-term`)) ? (FD.getAll(`${taxonomy}-term`)) : null;

            if (_.isArray(singleTaxTerms)) {
                taxonomyQueries.push(`${taxonomy}:{${singleTaxTerms.join(',')}}`);
            }
        });
        if (taxonomyQueries.length > 1) {
            output.push(`taxonomies_${taxRel}="${taxonomyQueries.join(';')}"`);
        }
    }
    return output;
}

function lcpGetStartingWith(FD) {
    if (!FD.has('starting-with')) return [];

    const startingWith = FD.get('starting-with');
    let output = [];

    if ( ! _.isEmpty( startingWith ) ) {
        output.push(`starting_with="${startingWith}"`);
    }
    return output;
}

function lcpCreateShortcode(FD) {
    let parameters = [];

    // Categories
    parameters = parameters.concat(lcpGetCategories(FD));

    // Author
    parameters = parameters.concat(lcpGetAuthor(FD));

    // Tags
    parameters = parameters.concat(lcpGetTags(FD));

    // Custom taxonomies
    parameters = parameters.concat(lcpGetCustomTaxonomies(FD));

    // Starting with
    parameters = parameters.concat(lcpGetStartingWith(FD));

    // Date
    if (FD.has('month')) {
        const month = FD.get('month');
        if ( ! _.isEmpty( month ) ) {
            parameters.push(`monthnum="${month}"`);
        }

    }
    if (FD.has('year')) {
        const year = FD.get('year');
        if ( ! _.isEmpty( year ) ) {
            parameters.push(`year="${year}"`);
        }

    }

    // Date ranges
    if (FD.has('after')) {
        const after = FD.get('after');
        if ( ! _.isEmpty( after ) ) {
            parameters.push(`after="${after}"`);
        }

    }
    if (FD.has('before')) {
        const before = FD.get('before');
        if ( ! _.isEmpty( before ) ) {
            parameters.push(`before="${before}"`);
        }

    }

    // Search
    if (FD.has('search')) {
        const search = FD.get('search');
        if ( ! _.isEmpty( search ) ) {
            parameters.push(`search="${search}"`);
        }

    }

    // Exclude posts
    if (FD.has('lcp-exclude-posts')) {
        let exCurPost;
        let exPost;
        let separator;

        if (FD.has('excurpost') && '1' === FD.get('excurpost')) {
            exCurPost = 'this';
        } else {
            exCurPost = '';
        }
        exPost = FD.has('expost') ? FD.get('expost') : '';
        exPost = exPost.trim();

        separator = (exPost && exCurPost) ? (',') : '';

        if (!_.isEmpty(exCurPost) || !_.isEmpty(exPost)) {
            parameters.push(`excludeposts="${exCurPost}${separator}${exPost}"`);
        }
    }

    // Offset
    if (FD.has('offset')) {
        const offset = FD.get('offset');
        if ( ! _.isEmpty( offset ) ) {
            parameters.push(`offset="${offset}"`);
        }

    }

    // Post type
    if (FD.has('post-type-mode')) {
        const postTypeMode = FD.get('post-type-mode');
        let postType = [];

        if ('default' === postTypeMode)
            ; // Empty statement
        else if ('any' === postTypeMode) {
            postType = postTypeMode;
        } else if ('select' === postTypeMode) {
            _.each(FD.getAll('post-type'), function(value) {
                postType.push(value);
            });
            postType = postType.join(',');
        }
        if (!_.isEmpty(postType)) parameters.push(`post_type="${postType}"`);
    }

    // Post status
    if (FD.has('post-status-mode')) {
        const postStatusMode = FD.get('post-status-mode');
        let postStatus = [];

        if ('default' === postStatusMode)
            ; // Empty statement
        else if ('any' === postStatusMode) {
            postStatus = postStatusMode;
        } else if ('select' === postStatusMode) {
            _.each(FD.getAll('post-status'), function(value) {
                postStatus.push(value);
            });
            postStatus = postStatus.join(',');
        }
        if (!_.isEmpty(postStatus)) parameters.push(`post_status="${postStatus}"`);
    }

    // Show protected
    if (FD.has('show-protected')) {
        const showProtected = FD.get('show-protected');
        if ('1' === showProtected) {
            parameters.push('show_protected="yes"');
        }

    }

    // Parent post
    if (FD.has('parent-post')) {
        const parentPost = FD.get('parent-post');
        if (!_.isEmpty(parentPost)) {
            parameters.push(`post_parent="${parentPost}"`);
        }

    }

    // Custom fields
    if (FD.has('lcp-custom-fields')) {
        const customfieldName = FD.get('customfield-name');
        const customfieldValue = FD.get('customfield-value');

        if (!_.isEmpty(customfieldName) && !_.isEmpty(customfieldValue)) {
            parameters.push(`customfield_name="${customfieldName}" customfield_value="${customfieldValue}"`);
        }
    }


    return '[catlist ' + parameters.join(' ') + ']';
}

export default lcpCreateShortcode;
