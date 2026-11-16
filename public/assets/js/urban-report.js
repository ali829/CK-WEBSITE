
document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('photo-upload');
    const previewContainer = document.getElementById('image-preview');

    if (!fileInput || !previewContainer) return;

    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    const maxSize = 10 * 1024 * 1024;

    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];

        previewContainer.innerHTML = '';
        previewContainer.classList.add('hidden');

        if (!file) return;

        if (!allowedTypes.includes(file.type)) {
            alert('Format non autorisé. Utilisez JPEG, PNG ou WEBP.');
            fileInput.value = '';
            return;
        }

        if (file.size > maxSize) {
            alert('La taille de l’image ne doit pas dépasser 10 Mo.');
            fileInput.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = (event) => {
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(1);

            previewContainer.innerHTML = `
                <div class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-lg bg-emerald-950 overflow-hidden">
                        <img src="${event.target.result}"
                             alt="Preview"
                             class="w-full h-full object-cover">
                    </div>

                    <div>
                        <span class="text-xs font-semibold text-ink block">
                            ${file.name}
                        </span>
                        <span class="text-[10px] text-muted">
                            ${sizeInMB} Mo • Prêt à l'envoi
                        </span>
                    </div>
                </div>

                <button type="button"
                        id="remove-image"
                        class="text-muted hover:text-terracotta-600">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            `;

            previewContainer.classList.remove('hidden');

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            document.getElementById('remove-image').addEventListener('click', () => {
                fileInput.value = '';
                previewContainer.innerHTML = '';
                previewContainer.classList.add('hidden');
            });
        };

        reader.readAsDataURL(file);
    });
});
