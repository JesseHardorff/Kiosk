let categoryId;

let category1 = document.getElementsByClassName('category1');
let category2 = document.getElementsByClassName('category2');
let category3 = document.getElementsByClassName('category3');
let category4 = document.getElementsByClassName('category4');
let category5 = document.getElementsByClassName('category5');
let category6 = document.getElementsByClassName('category6');

function changeCategory(categoryId) {
    console.log(categoryId);
    let categories = [category1, category2, category3, category4, category5, category6];
    
    // Set all categories to inactive
    categories.forEach(category => {
        for (let i = 0; i < category.length; i++) {
            category[i].classList.add('inactive');
        }
    });
    
    // Set the selected category to active
    let selectedCategory = categories[categoryId - 1];
    for (let i = 0; i < selectedCategory.length; i++) {
        selectedCategory[i].classList.remove('inactive');
    }
}