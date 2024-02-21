const uploadInput = document.querySelector('#images');
const openBtn = document.querySelector('.admin__uploadBtn');
const preview = document.querySelector('.preview-images');

const triggerInput = () => uploadInput.click();

const changeHandler = event => {
	if (!event.target.files.length)
	{
		return;
	}

	const files = Array.from(event.target.files);

	preview.innerHTML = '';
	files.forEach(file => {
		if (!file.type.match('image'))
		{
			return;
		}
		const reader = new FileReader();

		reader.onload = function (ev){
			const src= ev.target.result;
			if (preview.children.length >= 12)
			{
				return preview.children.length >= 12;
			}
			preview.insertAdjacentHTML('afterbegin', `
			<div class="preview-image">
				<button class="preview-remove" type="button">
					<img src="/assets/images/common/close-search.svg" alt="remove">
				</button>
				<img src="${src}" alt="${file.name}"/>
				<div class="preview-info">
					<p class="preview-name">${file.name}</p>
				</div>
			</div>
			`);
			preview.querySelectorAll('.preview-remove').forEach(el => {
				el.addEventListener('click', () => {
					el.closest('.preview-image').remove();
				})
			});
		}
		reader.readAsDataURL(file);
	});
}
openBtn.addEventListener('click', triggerInput)
uploadInput.addEventListener('change', changeHandler)

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

