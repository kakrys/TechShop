//try to survive
const buttonsRender = document.querySelectorAll('.account__sideBarBtn');

buttonsRender.forEach(function (button){
	button.addEventListener('click', function (){
		const tabIndex = button.getAttribute('data-tab-Index');
		fetch('/adminRender/', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({tabIndex: tabIndex})
		})
			.then(response => response.text())
			.then(html => {
				const mainBlock = document.querySelector('.account__main');
				mainBlock.innerHTML = html;
				mainBlock.setAttribute('data-admin-cont', tabIndex);

			})
			.catch(error => console.error('Error:', error));
	})
});








// document.getElementById('loadProfile').addEventListener('click', function() {
// 	fetch('/adminRender/', {
// 		method: 'POST',
// 		headers: {
// 			'Content-Type': 'application/json'
// 		},
// 		body: JSON.stringify({id: 1})
// 	})
// 		.then(response => response.text())
// 		.then(html => {
// 			const mainBlock = document.querySelector('.account__main');
// 			mainBlock.innerHTML = html;
// 			mainBlock.setAttribute('data-admin-cont', '1');
// 		})
// 		.catch(error => console.error('Error:', error));
// });

