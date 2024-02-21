const uploadInput = document.querySelector('#images');
const openBtn = document.querySelector('.admin__uploadBtn');
const preview = document.querySelector('.preview-images');

const triggerInput = () => uploadInput.click();

const handleFile = (file) => {
	if (!file.type.match('image'))
	{
		return;
	}

	const reader = new FileReader();

	const loadImage = new Promise((resolve, reject) => {
		reader.onload = () => resolve(reader.result);
		reader.onerror = () => reject(reader.error);
	});

	reader.readAsDataURL(file);

	return loadImage.then(src => {
		preview.insertAdjacentHTML('afterbegin', `
			<div class="preview-image">
				<img src="${src}" alt="${file.name}"/>
				<div class="preview-info">
					<p class="preview-name">${file.name}</p>
				</div>
			</div>
			`);

			const childrenLength = preview.children.length;
			const maxImages = 11;

			if (childrenLength > maxImages)
			{
				document.querySelectorAll(`.preview-image:nth-child(n + ${maxImages + 1})`).forEach(el => {
				el.style.display = 'none';
			});
		}
	});
};

const handleFiles = (event) => {
	const files = Array.from(event.target.files);

	preview.innerHTML = '';

	const loadImages = files.map(handleFile);

	Promise.all(loadImages).then(() => {
		const maxImages = 11;

		const hiddenImg = document.querySelectorAll(`.preview-image:nth-child(n + ${maxImages + 1})`);

		if (hiddenImg.length > 0)
		{
			const detailModalOpen = document.createElement('div');
			detailModalOpen.className = 'preview-image-hide';

			const detailModalOpenText = document.createElement('div');
			detailModalOpenText.className = 'detailModal-open__text';
			detailModalOpenText.textContent = `+${hiddenImg.length}`;

			detailModalOpen.appendChild(detailModalOpenText);
			preview.appendChild(detailModalOpen);
		}
	});
};

openBtn.addEventListener('click', triggerInput);
uploadInput.addEventListener('change', handleFiles);

//upload main image
const fileName = document.querySelector('#admin__createForm_fileName');
const fileWrapper = document.querySelector('.admin__createForm_wrapper');
const defaultBtn = document.querySelector('#defaultBtn');
const customBtn = document.querySelector('#customBtn');
const image = document.querySelector(".admin__createForm_img");
const cancelBtn = document.querySelector("#admin__createForm_cancelBtn");

let regExp = /.:\\.+\\/;

function defaultBtnActive()
{
	defaultBtn.click();

	defaultBtn.addEventListener("change", function (){
		const file = this.files[0];
		if (file)
		{
			const reader = new FileReader();
			reader.onload = function (){
				const result = reader.result;
				image.style.display = 'block';
				image.src = result;
				fileWrapper.classList.add('active-wrapper');
			}
			cancelBtn.addEventListener("click", function (){
				image.src = "";
				image.style.display = 'none';
				fileWrapper.classList.remove('active-wrapper');
			});
			reader.readAsDataURL(file);
		}
		if (this.value)
		{
			let valueStorage = this.value.replace(regExp, ' ');
			fileName.textContent = valueStorage;
		}
	});
}

