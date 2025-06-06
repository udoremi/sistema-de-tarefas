document.addEventListener("DOMContentLoaded", () => {
    const dragArea = document.querySelector(".drag-area");
    // Se você usou a classe sugerida:
    const dragAreaButton = document.querySelector(".drag-area-browse-button");
    // Se não, e for o único botão dentro de drag-area:
    // const dragAreaButton = dragArea.querySelector('button');
    const fileInput = dragArea.querySelector('input[type="file"]#image');
    const headerText = dragArea.querySelector("header");
    const originalHeaderText = headerText.textContent;

    if (!dragArea || !dragAreaButton || !fileInput || !headerText) {
        console.error(
            "Um ou mais elementos da área de upload não foram encontrados."
        );
        return;
    }

    // 1. Lógica para o botão "Procurar a imagem"
    dragAreaButton.addEventListener("click", () => {
        fileInput.click(); // Simula o clique no input file
    });

    // 2. Lógica para quando um arquivo é selecionado (por clique ou drop)
    fileInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            headerText.textContent = `Arquivo: ${file.name}`;
            // Você pode adicionar uma função para mostrar a prévia da imagem aqui se desejar
            // showFilePreview(file);
        } else if (!dragArea.classList.contains("active")) {
            // Só restaura se não estiver em dragover
            headerText.textContent = originalHeaderText;
        }
    });

    // 3. Lógica para Drag and Drop

    // Prevenir comportamentos padrão para drag and drop
    ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
        dragArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false); // Previne que o navegador abra o arquivo se solto fora da area
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Adicionar classe 'active' e mudar texto quando arquivo está sobre a área
    ["dragenter", "dragover"].forEach((eventName) => {
        dragArea.addEventListener(
            eventName,
            () => {
                dragArea.classList.add("active");
                headerText.textContent = "Solte para carregar";
            },
            false
        );
    });

    // Remover classe 'active' e restaurar texto quando arquivo sai da área
    dragArea.addEventListener(
        "dragleave",
        () => {
            dragArea.classList.remove("active");
            // Só restaura o texto se nenhum arquivo foi selecionado/solto
            if (!fileInput.files || fileInput.files.length === 0) {
                headerText.textContent = originalHeaderText;
            }
        },
        false
    );

    // Quando um arquivo é solto na área
    dragArea.addEventListener(
        "drop",
        (event) => {
            dragArea.classList.remove("active");

            const dt = event.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                fileInput.files = files; // Associa os arquivos ao input
                const file = files[0];
                headerText.textContent = `Arquivo: ${file.name}`;
                // Dispara o evento 'change' manualmente para que a lógica em fileInput.addEventListener('change',...) seja executada
                const changeEvent = new Event("change");
                fileInput.dispatchEvent(changeEvent);
                // showFilePreview(file);
            } else {
                if (!fileInput.files || fileInput.files.length === 0) {
                    headerText.textContent = originalHeaderText;
                }
            }
        },
        false
    );
});
