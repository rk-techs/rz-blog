'use strict';

/**
 * 指定したidのセレクトボックが変更された時
 *
 * @param {string} targetIdName -セレクトボックスのID
 */
function submitForm(targetIdName) {
    document.getElementById(targetIdName).addEventListener('change', () => {
        performFilter();
    });
}

submitForm('categorySelector');
submitForm('tagOptionSelector');

/** 複数のタグチェックボックス */
const checkboxes = document.getElementsByName('tag_slugs[]');
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        const label = checkbox.closest('.tag-label');
        checkbox.checked ? label.classList.add('tag-checked') : label.classList.remove('tag-checked');

        performFilter();
    });
});

const mobileFilterTrigger = document.getElementById('mobileFilterTrigger');
const mobileFilterBlock = document.getElementById('mobileFilterBlock');
const mobileFilterBack = document.getElementById('mobileFilterBack');

mobileFilterTrigger.addEventListener('click', () => {
  mobileFilterBlock.classList.toggle('show');
  document.body.classList.toggle('filter-open')
});

mobileFilterBack.addEventListener('click', () => {
  mobileFilterBlock.classList.toggle('show');
  document.body.classList.toggle('filter-open')
});

/* -----------------------
Ajax
----------------------- */
function performFilter() {
  const selectedCategory = document.getElementById("categorySelector").value;
  const selectedTagOption = document.getElementById("tagOptionSelector").value;
  const selectedTagSlugs = Array.from(document.querySelectorAll('input[name="tag_slugs[]"]:checked')).map(e => e.value);

  console.log(ajaxFilterRoute);

  const params = new URLSearchParams();
  params.append('category_slug', selectedCategory);
  selectedTagSlugs.forEach(tag => params.append('tag_slugs[]', tag));
  params.append('tag_option', selectedTagOption);

  const url = `${ajaxFilterRoute}?${params.toString()}`;
  console.log(url);

  fetch(url)
    .then(response => {
      if (!response.ok) {
        throw new Error(`Network response was not ok, status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      console.log('Received data:', data);

      // posts-listをクリア
      const postsList = document.querySelector('.posts-list');
      postsList.innerHTML = '';

      const filterBody = document.querySelector('.filter-body');
      if (filterBody) {
          updateOrInsertFilterResult(filterBody, data.filteredPostCount);
      }

      data.posts.forEach((post, index) => {
        const postItem = document.createElement('div');
        postItem.classList.add('post-item');

        const postLink = document.createElement('a');
        postLink.classList.add('post-item-link');
        postLink.href = `/posts/${post.slug}`;

        // published_at
        const postPublishedAt = document.createElement('div');
        postPublishedAt.classList.add('post-published-at');
        postPublishedAt.textContent = formatDateToYMD(post.published_at);

        // title
        const postTitle = document.createElement('h2');
        postTitle.classList.add('post-title');
        postTitle.textContent = post.title;

        // tags
        const tagsList = document.createElement('div');
        tagsList.classList.add('tags-list');

        if (post.tags) {
          post.tags.forEach(tag => {
            const tagItem = document.createElement('div');
            tagItem.classList.add('tag-item');

            const tagLabel = document.createElement('span');
            tagLabel.classList.add('tag-label', 'ignore-pointer');
            tagLabel.textContent = tag.name;

            tagItem.appendChild(tagLabel);
            tagsList.appendChild(tagItem);
          });
        } else {
          console.warn('Tags are undefined for post', post);
        }

        // row number
        const rowNum = document.createElement('div');
        rowNum.classList.add('post-row-num');
        rowNum.textContent = data.posts.length - index;

        // Assemble the post item
        postLink.appendChild(postPublishedAt);
        postLink.appendChild(postTitle);
        postLink.appendChild(tagsList);
        postLink.appendChild(rowNum);

        postItem.appendChild(postLink);
        postsList.appendChild(postItem);
      });

    })
    .catch(error => {
      insertErrorElement('検索エラーが発生しました... ;(');
      console.error('There was a problem with the fetch operation:', error);
    });

}

function createErrorElement(errorMessage) {
  const errorElement = document.createElement('div');
  errorElement.classList.add('filter-invalid-feedback');
  errorElement.textContent = errorMessage;
  return errorElement;
}

function insertErrorElement(errorMessage) {
  const errorElement = createErrorElement(errorMessage);

  const filterBlock = document.getElementById('filterBlock');
  const filterBody = filterBlock.querySelector('.filter-body');

  filterBody.insertAdjacentElement('beforebegin', errorElement);
}

function updateOrInsertFilterResult(filterBody, count) {
  const existingFilterResult = document.querySelector(".filter-result");

  if (existingFilterResult) {
      existingFilterResult.textContent = `${count} 件`;
      return;
  }

  const filterResultElement = createFilterResultElement(count);
  filterBody.insertAdjacentElement('beforeend', filterResultElement);
}

function createFilterResultElement(count) {
  const resultDiv = document.createElement('div');
  resultDiv.classList.add('filter-result');
  resultDiv.textContent = `${count} 件`;
  return resultDiv;
}

function formatDateToYMD(dateString) {
  const date  = new Date(dateString);
  const year  = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day   = String(date.getDate()).padStart(2, '0');

  return `${year}-${month}-${day}`;
}
