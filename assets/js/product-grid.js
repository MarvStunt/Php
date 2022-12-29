// Liste des produits à afficher
const products = [
	{
		name: 'One Piece - Édition Originale - Tome 1',
		price: 10,
		image: 'assets/img/onePieceTome12.png'
	},
	{
		name: 'Nom du produit 2',
		price: 20,
		image: 'image2.jpg'
	},
	// etc.
];

// Référence au conteneur de la grille de produits
const productGrid = document.getElementById('product-grid');

// Fonction de création d'un produit
function createProduct(product) {
	// Création de la structure HTML du produit
	const productElem = document.createElement('div');
	productElem.classList.add('product');
	productElem.innerHTML = `
		<img src="${product.image}" alt="${product.name}">
		<div class="product-info">
			<h2 class="product-name">${product.name}</h2>
			<div class="product-price">${product.price}€</div>
		</div>
	`;

	// Ajout du produit à la grille
	productGrid.appendChild(productElem);
}

// Génération de la grille de produits
products.forEach(createProduct);
