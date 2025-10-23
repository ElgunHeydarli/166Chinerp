"use strict";

function convert_letter(item) {
    item.value = item.value.replace(/[^a-zA-ZğüşıöəƏçĞÜŞİÖÇn _]/g, "");
}

function convert_numeric(item) {
    let cleaned = item.value.replace(/[^0-9.]/g, "");
    const parts = cleaned.split(".");
    if (parts.length > 2) {
        cleaned = parts[0] + "." + parts.slice(1).join("");
    }
    if (
        !cleaned.includes(".") &&
        cleaned.startsWith("0") &&
        cleaned.length > 1
    ) {
        cleaned = cleaned.replace(/^0+/, "");
    }

    item.value = cleaned;
}

function convert_alphanumeric(item) {
    item.value = item.value.replace(/[^a-zA-Z0-9 ]/g, "");
}

function convert_phone_number(item) {
    const value = item.value;

    // Rəqəmləri ayırırıq, amma başdakı +994-ü saxlamırıq (yenidən əlavə edəcəyik)
    let digits = value.replace(/\D/g, "");

    // Əgər 994 ilə başlayırsa, onu çıxarırıq, çünki funksiyada +994 olacaq
    if (digits.startsWith("994")) {
        digits = digits.slice(3);
    }

    // Maksimum 9 rəqəm (50xxxxxxxx)
    digits = digits.slice(0, 9);

    // Formatlama
    let formatted = "+994";
    if (digits.length > 0) {
        formatted += "(" + digits.slice(0, 2);
    }
    if (digits.length >= 2) {
        formatted += ") ";
    }
    if (digits.length >= 5) {
        formatted += digits.slice(2, 5) + "-";
    } else if (digits.length > 2) {
        formatted += digits.slice(2);
    }
    if (digits.length >= 7) {
        formatted += digits.slice(5, 7) + "-";
    } else if (digits.length > 5) {
        formatted += digits.slice(5);
    }
    if (digits.length >= 9) {
        formatted += digits.slice(7, 9);
    } else if (digits.length > 7) {
        formatted += digits.slice(7);
    }

    item.value = formatted;
}

async function upload_files(item) {
    let files = item.files;
    let employeeFileUpload = document.querySelector(".employeeFile-fileUpload");
    if (files.length > 0) {
        [...files].forEach(async (file) => {
            let employeeFileUploadArea = document.createElement("div");
            employeeFileUploadArea.className = "employeeFile-fileUpload-area";
            employeeFileUploadArea.innerHTML = `
              <img src="/back/assets/images/pdfImg.svg" alt="">
              <div class="employeeFile-fileUpload-main">
                  <div class="employeeFile-fileUpload-top">
                      <span class="employeeFile-FileName">${file.name}</span>
                      <p class="employeeFile-fileSize">${(
                          file.size /
                          (1024 * 1024)
                      ).toFixed(2)} MB</p>
                  </div>
                  <div class="employeeFile-fileProgress">
                      <div class="uploadLine"></div>
                  </div>
              </div>
              <button class="removeEmployeeFile" onclick="remove_file(this)" type="button">
                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              </button>
          `;

            employeeFileUpload.appendChild(employeeFileUploadArea);

            let employeeFile_uploadLine =
                employeeFileUploadArea.querySelector(".uploadLine");
            employeeFile_uploadLine.style.transition = "none";
            employeeFile_uploadLine.style.width = "0%";

            await new Promise((resolve) => setTimeout(resolve, 100));

            employeeFile_uploadLine.style.transition = "width 0.5s linear";

            simulateFileUploadProgress(employeeFile_uploadLine);
        });
    }
}

const simulateFileUploadProgress = (progressElement) => {
    let progress = 0;
    const interval = setInterval(() => {
        progress += 10;
        progressElement.style.width = `${progress}%`;
        if (progress >= 100) clearInterval(interval);
    }, 50);
};

function remove_file(item) {
    item.parentElement.remove(item);
}
