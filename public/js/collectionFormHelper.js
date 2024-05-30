import '../../assets/bootstrap.js';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../../assets/styles/app.css';

function addCustomCollectionAtribute(e) {
    const collectionHolder = document.querySelector('#custom-attribute-wrapper');
    const item = document.createElement('div');
    item.className = 'item';
  
    item.innerHTML = collectionHolder
      .dataset
      .prototype
      .replace(
        /__name__/g,
        collectionHolder.dataset.index
      );
  
    collectionHolder.appendChild(item);
  
    collectionHolder.dataset.index++;

    addRemoveCollectionAttributeButton(item);
}

function addRemoveCollectionAttributeButton(item) {
    const removeFormButton = document.createElement('button');
    removeFormButton.innerText = 'Delete';

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        item.remove();
    });
}

document.addEventListener('DOMContentLoaded', () => {
    document
        .querySelector('#add-custom-attribute')
        .addEventListener('click', (e) => {
            e.preventDefault();

            addCustomCollectionAtribute(e);
        })

    document
        .querySelectorAll('#custom-attribute-wrapper div.item')
        .forEach( (row) => {
            addRemoveCollectionAttributeButton(row);
        })
})