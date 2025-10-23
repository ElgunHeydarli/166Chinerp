const current_btn = document.querySelector(".current-lang");

current_btn?.addEventListener("click", (e) => {
    e.stopPropagation();
    notification_btn.parentElement.classList.remove("showNotification");
    adminDropDown_btn.parentElement.classList.remove("showAdminDrop");

    const parent = current_btn.parentElement;
    if (parent.classList.contains("showLang")) {
        parent.classList.remove("showLang");
    } else {
        current_btn.parentElement.classList.remove("showLang");
        parent.classList.add("showLang");
    }
});
document.addEventListener("click", (e) => {
    const parent = current_btn.parentElement;
    if (!parent.contains(e.target)) {
        parent.classList.remove("showLang");
    }
});

const notification_btn = document.querySelector(".notification_btn");

notification_btn?.addEventListener("click", (e) => {
    e.stopPropagation();
    current_btn.parentElement.classList.remove("showLang");
    adminDropDown_btn.parentElement.classList.remove("showAdminDrop");

    const parent = notification_btn.parentElement;
    if (parent.classList.contains("showNotification")) {
        parent.classList.remove("showNotification");
    } else {
        notification_btn.parentElement.classList.remove("showNotification");
        parent.classList.add("showNotification");
    }
});
document.addEventListener("click", (e) => {
    const parent = notification_btn.parentElement;
    if (!parent.contains(e.target)) {
        parent.classList.remove("showNotification");
    }
});

const adminDropDown_btn = document.querySelector(".adminDropDown_btn");

adminDropDown_btn?.addEventListener("click", (e) => {
    e.stopPropagation();
    current_btn.parentElement.classList.remove("showLang");
    notification_btn.parentElement.classList.remove("showNotification");

    const parent = adminDropDown_btn.parentElement;
    if (parent.classList.contains("showAdminDrop")) {
        parent.classList.remove("showAdminDrop");
    } else {
        adminDropDown_btn.parentElement.classList.remove("showAdminDrop");
        parent.classList.add("showAdminDrop");
    }
});
document.addEventListener("click", (e) => {
    const parent = adminDropDown_btn.parentElement;
    if (!parent.contains(e.target)) {
        parent.classList.remove("showAdminDrop");
    }
});

document.addEventListener("DOMContentLoaded", () => {
    active_tab_content();
});

function active_tab_content() {
    const order_tab_btns = document.querySelectorAll(".order_tab_btn");
    const sub_orderTabContent = document.querySelectorAll(
        ".sub_orderTabContent"
    );
    order_tab_btns.forEach((order_tab_btn) => {
        let id = order_tab_btn.id;
        let relatedContent = document.querySelector(
            `.sub_orderTabContent[data-id="${id}"]`
        );

        if (order_tab_btn.classList.contains("active")) {
            relatedContent.style.display = "block";
        }

        order_tab_btn?.addEventListener("click", () => {
            order_tab_btns.forEach((btn) => btn.classList.remove("active"));
            sub_orderTabContent.forEach(
                (content) => (content.style.display = "none")
            );

            order_tab_btn.classList.add("active");
            relatedContent.style.display = "block";
        });
    });
}

//=======================================================================
const draft_operation_btns = document.querySelectorAll(".draft-operation-btn");
draft_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            draft_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    draft_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

const rejectDraftOrders = document.querySelectorAll(".rejectDraftOrder");
const closeRejectOrderModal = document.querySelector(".closeRejectOrderModal");
const reject_draftOrder_modal_container = document.querySelector(
    ".reject_draftOrder_modal_container"
);
rejectDraftOrders.forEach((btn) => {
    btn?.addEventListener("click", () => {
        draft_operation_btns.forEach((btn2) =>
            btn2.parentElement.classList.remove("active")
        );
        reject_draftOrder_modal_container.classList.add("activeModal");
    });
});
closeRejectOrderModal?.addEventListener("click", () => {
    reject_draftOrder_modal_container.classList.remove("activeModal");
});
const editDraftOrders = document.querySelectorAll(".editDraftOrder");
const closeEditOrderModal = document.querySelector(".closeEditOrderModal");
const edit_draftOrder_modal_container = document.querySelector(
    ".edit_draftOrder_modal_container"
);
editDraftOrders.forEach((btn) => {
    btn?.addEventListener("click", () => {
        draft_operation_btns.forEach((btn2) =>
            btn2.parentElement.classList.remove("active")
        );
        edit_draftOrder_modal_container.classList.add("activeModal");
    });
});
closeEditOrderModal?.addEventListener("click", () => {
    edit_draftOrder_modal_container.classList.remove("activeModal");
});
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        reject_draftOrder_modal_container.classList.remove("activeModal");
        edit_draftOrder_modal_container.classList.remove("activeModal");
        unclaimedCargo_modal_container.classList.remove("activeModal");
    }
});

//==============================================================================

const addNewsUnclaimedCargo = document.querySelector(".addNewsUnclaimedCargo");
const unclaimedCargo_modal_container = document.querySelector(
    ".unclaimedCargo_modal_container"
);
const close_unclaimedCargo_modal = document.querySelector(
    ".close_unclaimedCargo_modal"
);

addNewsUnclaimedCargo?.addEventListener("click", () => {
    console.log("salam");
    unclaimedCargo_modal_container.classList.add("activeModal");
});
close_unclaimedCargo_modal?.addEventListener("click", () => {
    unclaimedCargo_modal_container.classList.remove("activeModal");
});

//==============================================================================

document.querySelectorAll('.file-area input[type="file"]').forEach((input) => {
    input?.addEventListener("change", function () {
        let fileArea = this.closest(".file-area"); // Parent olan file-area'yı bul
        let fileNameSpan = fileArea.querySelector(".fileName");

        if (this.files.length > 0) {
            fileNameSpan.textContent = this.files[0].name; // Dosya adını yazdır
            fileArea.classList.add("active"); // active sınıfını ekle
        } else {
            fileNameSpan.textContent = ""; // Dosya seçilmezse boş bırak
            fileArea.classList.remove("active"); // active sınıfını kaldır
        }
    });
});

//==============================================================================

const container_operation_btns = document.querySelectorAll(
    ".container-operation-btn"
);

// Butona tıklama
container_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            container_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    container_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

//==============================================================================

const vendor_operation_btns = document.querySelectorAll(
    ".vendor-operation-btn"
);

// Butona tıklama
vendor_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            vendor_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    vendor_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});
//==============================================================================

const container_tab_btns = document.querySelectorAll(".container_tab_btn");
const sub_containerTabContents = document.querySelectorAll(
    ".sub_containerTabContent"
);
container_tab_btns.forEach((container_tab_btn) => {
    container_tab_btn?.addEventListener("click", () => {
        container_tab_btns.forEach((container_tab_btn2) =>
            container_tab_btn2.classList.remove("active")
        );
        sub_containerTabContents.forEach(
            (sub_containerTabContents2) =>
                (sub_containerTabContents2.style.display = "none")
        );
        container_tab_btn.classList.add("active");
        let id = container_tab_btn.id;
        document.querySelector(
            `.sub_containerTabContent[data-id="${id}"]`
        ).style.display = "block";
    });
});

//==============================================================================

const paymentInput = document.querySelector('.paymentFile input[type="file"]');
const removeReservationFile = document.querySelector(".removeReservationFile");
const reservation_fileUpload_area = document.querySelector(
    ".payment_modal .fileUpload-area"
);
const payment_fileNameSpan = document.querySelector(
    ".fileUpload-top .paymentFileName"
);
const payment_fileSizeP = document.querySelector(".fileUpload-top .fileSize");
const payment_uploadLine = document.querySelector(".fileProgress .uploadLine");
paymentInput?.addEventListener("change", async function () {
    if (this.files.length > 0) {
        reservation_fileUpload_area.style.display = "flex";
        const file = this.files[0];
        payment_fileNameSpan.textContent = file.name;

        // Dosya boyutunu MB olarak hesapla
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
        payment_fileSizeP.textContent = `${fileSizeMB} MB`;

        // Yükleme çubuğunu sıfırla
        payment_uploadLine.style.transition = "none";
        payment_uploadLine.style.width = "0%";

        // 100ms gecikme ile animasyon sıfırlama
        await new Promise((resolve) => setTimeout(resolve, 100));

        payment_uploadLine.style.transition = "width 0.5s linear";
        simulateFileUpload(payment_uploadLine);
    } else {
        payment_fileNameSpan.textContent = "";
        payment_fileSizeP.textContent = "";
        payment_uploadLine.style.width = "0%";
    }
});
removeReservationFile?.addEventListener("click", () => {
    paymentInput.value = "";
    reservation_fileUpload_area.style.display = "none";
});

// **Gerçek zamanlı yükleme ilerlemesini simüle eden ES6 fonksiyonu**
const simulateFileUpload = (uploadLine) => {
    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 10; // Rastgele ilerleme

        if (progress >= 100) {
            progress = 100;
            uploadLine.style.width = `${progress}%`;
            uploadLine.style.backgroundColor = "#32b558"; // ✅ Tamamlandıqda yaşıl
            uploadLine.parentElement.parentElement.nextElementSibling.style.display = "none";
            clearInterval(interval);
        } else {
            uploadLine.style.width = `${progress}%`;
            uploadLine.style.backgroundColor = "#00a3e8"; // Yükləmə zamanı mavi
            uploadLine.parentElement.parentElement.nextElementSibling.style.display = "inline-block";
        }
    }, 50);
};


const paymetBtns = document.querySelectorAll(".paymetBtn");
const payment_modal_container = document.querySelector(
    ".payment_modal_container"
);
const closePaymentModal = document.querySelector(".closePaymentModal");
paymetBtns.forEach((paymetBtn) => {
    paymetBtn?.addEventListener("click", () => {
        payment_modal_container.classList.add("activeModal");
    });
});
closePaymentModal?.addEventListener("click", () => {
    payment_modal_container.classList.remove("activeModal");
    paymentInput.value = ""; // Dosya girişini sıfırla
    payment_fileNameSpan.textContent = "";
    payment_fileSizeP.textContent = "";
    payment_uploadLine.style.width = "0%";
    reservation_fileUpload_area.style.display = "none";
});

//==============================================================================
const employee_operation_btns = document.querySelectorAll(
    ".employee-operation-btn"
);

// Butona tıklama
employee_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            employee_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    employee_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

//==============================================================================
const service_operation_btns = document.querySelectorAll(
    ".service-operation-btn"
);

// Butona tıklama
service_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            service_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    service_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

//==============================================================================
const reservateDate_operation_btns = document.querySelectorAll(
    ".reservateDate-operation-btn"
);

// Butona tıklama
reservateDate_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            reservateDate_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    reservateDate_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

const reservateDateView_operation_btns = document.querySelectorAll(
    ".reservateDateView-operation-btn"
);

// Butona tıklama
reservateDateView_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            reservateDateView_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    reservateDateView_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

//==============================================================================
const reservateDate_tab_btns = document.querySelectorAll(
    ".reservateDate_tab_btn"
);
const sub_reservateDateTabContents = document.querySelectorAll(
    ".sub_reservateDateTabContent"
);
reservateDate_tab_btns.forEach((reservateDate_tab_btn) => {
    reservateDate_tab_btn?.addEventListener("click", () => {
        reservateDate_tab_btns.forEach((reservateDate_tab_btn2) =>
            reservateDate_tab_btn2.classList.remove("active")
        );
        sub_reservateDateTabContents.forEach(
            (sub_reservateDateTabContent2) =>
                (sub_reservateDateTabContent2.style.display = "none")
        );
        reservateDate_tab_btn.classList.add("active");
        let id = reservateDate_tab_btn.id;
        document.querySelector(
            `.sub_reservateDateTabContent[data-id="${id}"]`
        ).style.display = "block";
    });
});

const reservateDateChange_modal_container = document.querySelector(
    ".reservateDateChange_modal_container"
);
const closeReservateDateChangeModal = document.querySelector(
    ".closeReservateDateChangeModal"
);
const changeReservedTime = document.querySelector(".changeReservedTime");
changeReservedTime?.addEventListener("click", () => {
    reservateDateChange_modal_container.classList.add("activeModal");
    changeReservedTime.parentElement.parentElement.classList.remove("active");
});
closeReservateDateChangeModal?.addEventListener("click", () => {
    reservateDateChange_modal_container.classList.remove("activeModal");
});

const editReservateDate_modal_container = document.querySelector(
    ".editReservateDate_modal_container"
);
const closeEditReservateDate = document.querySelector(
    ".closeEditReservateDate"
);
const changeStatusReservateDates = document.querySelectorAll(
    ".changeStatusReservateDate"
);
changeStatusReservateDates.forEach((changeStatusReservateDate) => {
    changeStatusReservateDate?.addEventListener("click", () => {
        editReservateDate_modal_container.classList.add("activeModal");
        changeStatusReservateDate.parentElement.parentElement.classList.remove(
            "active"
        );
    });
});

closeEditReservateDate?.addEventListener("click", () => {
    editReservateDate_modal_container.classList.remove("activeModal");
});

const setReservationTime_modal_container = document.querySelector(
    ".setReservationTime_modal_container"
);
const closeSetReservationTime = document.querySelector(
    ".closeSetReservationTime"
);
const setReservationDateBtn = document.querySelector(".setReservationDateBtn");
setReservationDateBtn?.addEventListener("click", () => {
    setReservationTime_modal_container.classList.add("activeModal");
});
closeSetReservationTime?.addEventListener("click", () => {
    setReservationTime_modal_container.classList.remove("activeModal");
});

const containerCheckBoxes = document.querySelectorAll(
    '.containerIsCheck-table input[type="checkbox"]'
);
const containerIsCheck_filter = document.querySelector(
    ".containerIsCheck-filter"
);

if (containerIsCheck_filter || setReservationDateBtn) {
    const toggleElements = () => {
        const anyChecked = [...containerCheckBoxes].some((chk) => chk.checked);
        containerIsCheck_filter.style.display = anyChecked ? "none" : "flex";
        setReservationDateBtn.style.display = anyChecked ? "flex" : "none";
    };

    containerCheckBoxes.forEach((chk) =>
        chk.addEventListener("change", toggleElements)
    );
    toggleElements();
}

//==============================================================================

const chineFileInput = document.querySelectorAll(
    ".chine-progressOrders-table .pdf-item input"
);
chineFileInput.forEach((item) => {
    item?.addEventListener("change", () => {
        if (item.files.length > 0) {
            item.parentElement.classList.add("active");
            console.log("yuklendi");
        } else {
            item.parentElement.classList.remove("active");
        }
    });
});

const chine_operation_btns = document.querySelectorAll(".chine-operation-btn");

// Butona tıklama
chine_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            chine_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    chine_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

const chineReserved_modal_container = document.querySelector(
    ".chineReserved_modal_container"
);
const closeChineReservedModal = document.querySelector(
    ".closeChineReservedModal"
);
const chineBeReservations = document.querySelectorAll(".chineBeReservation");
chineBeReservations.forEach((btn) => {
    btn?.addEventListener("click", () => {
        chineReserved_modal_container.classList.add("activeModal");
    });
});

closeChineReservedModal?.addEventListener("click", () => {
    chineReserved_modal_container.classList.remove("activeModal");
});

//==============================================================================
const accountTable_operation_btns = document.querySelectorAll(
    ".accountTable-operation-btn"
);

accountTable_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            accountTable_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    accountTable_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

//==============================================================================
const costManagement_operation_btns = document.querySelectorAll(
    ".costManagement-operation-btn"
);

costManagement_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            costManagement_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    costManagement_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

//==============================================================================
const receivableTable_operation_btns = document.querySelectorAll(
    ".receivableTable-operation-btn"
);

receivableTable_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            receivableTable_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    receivableTable_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

//==============================================================================
const payable_operation_btns = document.querySelectorAll(
    ".payable-operation-btn"
);

payable_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            payable_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    payable_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

//==============================================================================

const progressItem_modal = document.querySelector(".progressItem-modal");
const closeProgressItem = document.querySelector(".closeProgressItem");
const trackingId = document.querySelectorAll(".tracking-id");
trackingId.forEach((btn) => {
    btn?.addEventListener("click", () => {
        progressItem_modal.classList.add("activeModal");
    });
});

closeProgressItem?.addEventListener("click", () => {
    progressItem_modal.classList.remove("activeModal");
});

//==============================================================================
const rejectContainerOrders = document.querySelectorAll(
    ".rejectContainerOrder"
);
const closeRejectContainerModal = document.querySelector(
    ".closeRejectContainerModal"
);
const reject_container_modal_container = document.querySelector(
    ".reject_container_modal_container"
);
rejectContainerOrders.forEach((btn) => {
    btn?.addEventListener("click", () => {
        draft_operation_btns.forEach((btn2) =>
            btn2.parentElement.classList.remove("active")
        );
        reject_container_modal_container.classList.add("activeModal");
    });
});
closeRejectContainerModal?.addEventListener("click", () => {
    reject_container_modal_container.classList.remove("activeModal");
});

//==============================================================================

const reservationPrice_operation_btns = document.querySelectorAll(
    ".reservationPrice-operation-btn"
);

reservationPrice_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            reservationPrice_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    reservationPrice_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

const editReservationPrices = document.querySelectorAll(
    ".editReservationPrice"
);
const closeReservationPriceModal = document.querySelector(
    ".closeReservationPriceModal"
);
const reject_reservationPrice_modal_container = document.querySelector(
    ".reject_reservationPrice_modal_container"
);
editReservationPrices.forEach((btn) => {
    btn?.addEventListener("click", () => {
        draft_operation_btns.forEach((btn2) =>
            btn2.parentElement.classList.remove("active")
        );
        reject_reservationPrice_modal_container.classList.add("activeModal");
    });
});
closeReservationPriceModal?.addEventListener("click", () => {
    reject_reservationPrice_modal_container.classList.remove("activeModal");
});

const addReservationPrice = document.querySelector(".addReservationPriceBtn");
const closeAddReservationPriceModal = document.querySelector(
    ".closeAddReservationPriceModal"
);
const add_reservationPrice_modal_container = document.querySelector(
    ".add_reservationPrice_modal_container"
);

addReservationPrice?.addEventListener("click", () => {
    add_reservationPrice_modal_container.classList.add("activeModal");
});

closeAddReservationPriceModal?.addEventListener("click", () => {
    add_reservationPrice_modal_container.classList.remove("activeModal");
});

//=======================================================================
const railWayFileInput = document.querySelector(
    '.railWayFile input[type="file"]'
);
const removeRailWayFile = document.querySelector(".removeRailWayFile");
const closeRailwayFileModal = document.querySelector(".closeRailwayFileModal");
const railwayFileModal_container = document.querySelector(
    ".railwayFileModal_container"
);
const railWayFile_fileUpload_area = document.querySelector(
    ".railWayFile-fileUpload"
);
const railWayFile_fileNameSpan = document.querySelector(
    ".railWayFile-fileUpload-top .railWayFile-FileName"
);
const railWayFile_fileSizeP = document.querySelector(
    ".railWayFile-fileUpload-top .railWayFile-fileSize"
);
const railWayFile_uploadLine = document.querySelector(
    ".railWayFile-fileProgress .uploadLine"
);
railWayFileInput?.addEventListener("change", async function () {
    if (this.files.length > 0) {
        railWayFile_fileUpload_area.style.display = "flex";
        const file = this.files[0];
        railWayFile_fileNameSpan.textContent = file.name;

        // Dosya boyutunu MB olarak hesapla
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
        railWayFile_fileSizeP.textContent = `${fileSizeMB} MB`;

        // Yükleme çubuğunu sıfırla
        railWayFile_uploadLine.style.transition = "none";
        railWayFile_uploadLine.style.width = "0%";

        // 100ms gecikme ile animasyon sıfırlama
        await new Promise((resolve) => setTimeout(resolve, 100));
        railWayFile_uploadLine.style.transition = "width 0.5s linear";
        simulateFileUpload(railWayFile_uploadLine);
    } else {
        railWayFile_fileNameSpan.textContent = "";
        railWayFile_fileSizeP.textContent = "";
        railWayFile_uploadLine.style.width = "0%";
    }
});
removeRailWayFile?.addEventListener("click", () => {
    railWayFileInput.value = "";
    railWayFile_fileUpload_area.style.display = "none";
});

closeRailwayFileModal?.addEventListener("click", () => {
    railwayFileModal_container.classList.remove("activeModal");
    railWayFileInput.value = "";
    railWayFile_fileUpload_area.style.display = "none";
    railWayFile_fileNameSpan.textContent = "";
    railWayFile_fileSizeP.textContent = "";
    railWayFile_uploadLine.style.width = "0%";
});
const upload_raleways = document.querySelectorAll(".upload_raleway");
upload_raleways.forEach((upload_raleway) => {
    upload_raleway?.addEventListener("click", () => {
        railwayFileModal_container.classList.add("activeModal");
    });
});

//=======================================================================
const edit_railWayFileInput = document.querySelector(
    '.edit_railWayFile input[type="file"]'
);
const edit_removeRailWayFile = document.querySelector(
    ".edit_removeRailWayFile"
);
const edit_closeRailwayFileModal = document.querySelector(
    ".edit_closeRailwayFileModal"
);
const edit_railwayFileModal_container = document.querySelector(
    ".edit_railwayFileModal_container"
);
const edit_railWayFile_fileUpload_area = document.querySelector(
    ".edit_railWayFile-fileUpload"
);
const edit_railWayFile_fileNameSpan = document.querySelector(
    ".edit_railWayFile-fileUpload-top .edit_railWayFile-FileName"
);
const edit_railWayFile_fileSizeP = document.querySelector(
    ".edit_railWayFile-fileUpload-top .edit_railWayFile-fileSize"
);
const edit_railWayFile_uploadLine = document.querySelector(
    ".edit_railWayFile-fileProgress .uploadLine"
);
edit_railWayFileInput?.addEventListener("change", async function () {
    if (this.files.length > 0) {
        edit_railWayFile_fileUpload_area.style.display = "flex";
        const file = this.files[0];
        edit_railWayFile_fileNameSpan.textContent = file.name;

        // Dosya boyutunu MB olarak hesapla
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
        edit_railWayFile_fileSizeP.textContent = `${fileSizeMB} MB`;

        // Yükleme çubuğunu sıfırla
        edit_railWayFile_uploadLine.style.transition = "none";
        edit_railWayFile_uploadLine.style.width = "0%";

        // 100ms gecikme ile animasyon sıfırlama
        await new Promise((resolve) => setTimeout(resolve, 100));

        edit_railWayFile_uploadLine.style.transition = "width 0.5s linear";
        simulateFileUpload(edit_railWayFile_uploadLine);
    } else {
        edit_railWayFile_fileNameSpan.textContent = "";
        edit_railWayFile_fileSizeP.textContent = "";
        edit_railWayFile_uploadLine.style.width = "0%";
    }
});
edit_removeRailWayFile?.addEventListener("click", () => {
    edit_railWayFileInput.value = "";
    edit_railWayFile_fileUpload_area.style.display = "none";
});

edit_closeRailwayFileModal?.addEventListener("click", () => {
    edit_railwayFileModal_container.classList.remove("activeModal");
});
const edit_upload_raleways = document.querySelectorAll(".edit_raleway");
edit_upload_raleways.forEach((edit_upload_raleway) => {
    edit_upload_raleway?.addEventListener("click", () => {
        edit_railwayFileModal_container.classList.add("activeModal");
    });
});

//=======================================================================
const declarationFileInput = document.querySelector(
    '.declarationFile input[type="file"]'
);
const removeDeclarationFile = document.querySelector(".removeDeclarationFile");
const closeDeclarationFileModal = document.querySelector(
    ".closeDeclarationFileModal"
);
const declarationFileModal_container = document.querySelector(
    ".declarationFileModal_container"
);
const declarationFile_fileUpload_area = document.querySelector(
    ".declarationFile-fileUpload"
);
const declarationFile_fileNameSpan = document.querySelector(
    ".declarationFile-fileUpload-top .declarationFile-FileName"
);
const declarationFile_fileSizeP = document.querySelector(
    ".declarationFile-fileUpload-top .declarationFile-fileSize"
);
const declarationFile_uploadLine = document.querySelector(
    ".declarationFile-fileProgress .uploadLine"
);
declarationFileInput?.addEventListener("change", async function () {
    if (this.files.length > 0) {
        declarationFile_fileUpload_area.style.display = "flex";
        const file = this.files[0];
        declarationFile_fileNameSpan.textContent = file.name;

        // Dosya boyutunu MB olarak hesapla
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
        declarationFile_fileSizeP.textContent = `${fileSizeMB} MB`;

        // Yükleme çubuğunu sıfırla
        declarationFile_uploadLine.style.transition = "none";
        declarationFile_uploadLine.style.width = "0%";

        // 100ms gecikme ile animasyon sıfırlama
        await new Promise((resolve) => setTimeout(resolve, 100));

        declarationFile_uploadLine.style.transition = "width 0.5s linear";
        simulateFileUpload(declarationFile_uploadLine);
    } else {
        declarationFile_fileNameSpan.textContent = "";
        declarationFile_fileSizeP.textContent = "";
        declarationFile_uploadLine.style.width = "0%";
    }
});
removeDeclarationFile?.addEventListener("click", () => {
    declarationFileInput.value = "";
    declarationFile_fileUpload_area.style.display = "none";
});

closeDeclarationFileModal?.addEventListener("click", () => {
    declarationFileModal_container.classList.remove("activeModal");
    declarationFileInput.value = "";
    declarationFile_fileUpload_area.style.display = "none";
    declarationFile_fileNameSpan.textContent = "";
    declarationFile_fileSizeP.textContent = "";
    declarationFile_uploadLine.style.width = "0%";
});
const upload_declarations = document.querySelectorAll(".upload_declaration");
upload_declarations.forEach((upload_declaration) => {
    upload_declaration?.addEventListener("click", () => {
        declarationFileModal_container.classList.add("activeModal");
    });
});

//=======================================================================
const edit_declarationFileInput = document.querySelector(
    '.edit_declarationFile input[type="file"]'
);
const edit_removeDeclarationFile = document.querySelector(
    ".edit_removeDeclarationFile"
);
const edit_closeDeclarationFileModal = document.querySelector(
    ".edit_closeDeclarationFileModal"
);
const edit_declarationFileModal_container = document.querySelector(
    ".edit_declarationFileModal_container"
);
const edit_declarationFile_fileUpload_area = document.querySelector(
    ".edit_declarationFile-fileUpload"
);
const edit_declarationFile_fileNameSpan = document.querySelector(
    ".edit_declarationFile-fileUpload-top .edit_declarationFile-FileName"
);
const edit_declarationFile_fileSizeP = document.querySelector(
    ".edit_declarationFile-fileUpload-top .edit_declarationFile-fileSize"
);
const edit_declarationFile_uploadLine = document.querySelector(
    ".edit_declarationFile-fileProgress .uploadLine"
);
edit_declarationFileInput?.addEventListener("change", async function () {
    if (this.files.length > 0) {
        edit_declarationFile_fileUpload_area.style.display = "flex";
        const file = this.files[0];
        edit_declarationFile_fileNameSpan.textContent = file.name;

        // Dosya boyutunu MB olarak hesapla
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
        edit_declarationFile_fileSizeP.textContent = `${fileSizeMB} MB`;

        // Yükleme çubuğunu sıfırla
        edit_declarationFile_uploadLine.style.transition = "none";
        edit_declarationFile_uploadLine.style.width = "0%";

        // 100ms gecikme ile animasyon sıfırlama
        await new Promise((resolve) => setTimeout(resolve, 100));

        edit_declarationFile_uploadLine.style.transition = "width 0.5s linear";
        simulateFileUpload(edit_declarationFile_uploadLine);
    } else {
        edit_declarationFile_fileNameSpan.textContent = "";
        edit_declarationFile_fileSizeP.textContent = "";
        edit_declarationFile_uploadLine.style.width = "0%";
    }
});
edit_removeDeclarationFile?.addEventListener("click", () => {
    edit_declarationFileInput.value = "";
    edit_declarationFile_fileUpload_area.style.display = "none";
});

edit_closeDeclarationFileModal?.addEventListener("click", () => {
    edit_declarationFileModal_container.classList.remove("activeModal");
});
const edit_declarations = document.querySelectorAll(".edit_declaration");
edit_declarations.forEach((edit_declaration) => {
    edit_declaration?.addEventListener("click", () => {
        edit_declarationFileModal_container.classList.add("activeModal");
    });
});

//=======================================================================
const containerImgInput = document.querySelector(
    '.containerImgFile input[type="file"]'
);
const containerImgFiles = document.querySelector(".containerImgFiles");

// Yüklenen dosyaları saklamak için bir dizi
let uploadedFiles = [];

containerImgInput?.addEventListener("change", () => {
    if (containerImgInput.files.length > 0) {
        let newFiles = [...containerImgInput.files];

        // Daha önce eklenen dosyaları filtrele
        newFiles = newFiles.filter(
            (file) =>
                !uploadedFiles.some(
                    (f) => f.name === file.name && f.size === file.size
                )
        );

        if (newFiles.length === 0) return;

        uploadedFiles = [...uploadedFiles, ...newFiles];

        newFiles.forEach((file) => {
            addFileToDOM(file);
        });
    }
});

function addFileToDOM(file) {
    const containerImgFile_fileUpload = document.createElement("div");
    containerImgFile_fileUpload.className = "containerImgFile-fileUpload";
    containerImgFile_fileUpload.setAttribute("data-name", file.name);
    containerImgFile_fileUpload.setAttribute("data-size", file.size);

    containerImgFile_fileUpload.innerHTML = `
      <img src="./assets/images/pdfImg.svg" alt="">
      <div class="containerImgFile-fileUpload-main">
          <div class="containerImgFile-fileUpload-top">
              <span class="containerImgFile-FileName">${file.name}</span>
              <p class="containerImgFile-fileSize">${(
            file.size /
            (1024 * 1024)
        ).toFixed(2)} MB</p>
          </div>
          <div class="containerImgFile-fileProgress">
              <div class="uploadLine"></div>
          </div>
      </div>
      <button class="removeContainerImgFile" type="button">
          <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
      </button>
  `;

    containerImgFiles.appendChild(containerImgFile_fileUpload);

    // Progress Bar Efekti
    const containerImgFile_fileProgress =
        containerImgFile_fileUpload.querySelector(".uploadLine");
    containerImgFile_fileProgress.style.transition = "none";
    containerImgFile_fileProgress.style.width = "0%";

    setTimeout(() => {
        containerImgFile_fileProgress.style.transition = "width 0.5s linear";
        containerImgFile_fileProgress.style.width = "100%";
    }, 100);

    // Silme butonu
    const removeButton = containerImgFile_fileUpload.querySelector(
        ".removeContainerImgFile"
    );
    removeButton?.addEventListener("click", () => {
        uploadedFiles = uploadedFiles.filter(
            (f) => f.name !== file.name || f.size !== file.size
        );
        containerImgFile_fileUpload.remove();
    });
}

// Modal açma
const containerImgModal_container = document.querySelector(
    ".containerImgModal_container"
);
const closeContainerImgModal = document.querySelector(
    ".closeContainerImgModal"
);
const upload_containerImgs = document.querySelectorAll(".upload_containerImg");
upload_containerImgs.forEach((upload_containerImg) => {
    upload_containerImg?.addEventListener("click", () => {
        containerImgModal_container.classList.add("activeModal");
    });
});

// Modal kapatma
closeContainerImgModal?.addEventListener("click", () => {
    containerImgModal_container.classList.remove("activeModal");
    uploadedFiles = [];
    document
        .querySelectorAll(".containerImgFile-fileUpload")
        .forEach((item) => {
            item.remove();
        });
});

//=======================================================================
// Dosya input ve dosya listesinin bulunduğu container elementlerini seçiyoruz
const edit_containerImgInput = document.querySelector(
    '.edit_containerImgFile input[type="file"]'
);
const edit_containerImgFiles = document.querySelector(
    ".edit_containerImgFiles"
);

// Yüklenen dosyaları saklamak için bir dizi
let edit_uploadedFiles = [];

// Dosya input'a değişiklik (dosya yükleme) olayı ekliyoruz
edit_containerImgInput?.addEventListener("change", (event) => {
    const files = event.target.files;
    if (!files.length) return; // Eğer dosya seçilmediyse hiçbir şey yapma

    let edit_newFiles = [...files];

    // Aynı dosyanın eklenmesini engelle
    edit_newFiles = edit_newFiles.filter(
        (file) =>
            !edit_uploadedFiles.some(
                (f) =>
                    f.name === file.name && f.lastModified === file.lastModified
            )
    );

    if (!edit_newFiles.length) return; // Eğer ekleyecek yeni dosya yoksa çık

    // Yüklenen dosyaları mevcut dosya listesine ekle
    edit_uploadedFiles = [...edit_uploadedFiles, ...edit_newFiles];

    // Yeni dosyaları DOM'a ekle
    edit_newFiles.forEach((file) => edit_addFileToDOM(file));
});

// Dosyayı DOM'a eklemek için fonksiyon
function edit_addFileToDOM(file) {
    const edit_containerImgFile_fileUpload = document.createElement("div");
    edit_containerImgFile_fileUpload.className =
        "edit_containerImgFile-fileUpload";

    // Benzersiz bir ID oluşturuluyor (dosya adı ve son değiştirilme tarihi ile)
    const uniqueID = `${file.name}-${file.lastModified}`;
    edit_containerImgFile_fileUpload.setAttribute("data-id", uniqueID); // Dosya için benzersiz ID ekleniyor

    edit_containerImgFile_fileUpload.innerHTML = `
        <img src="./assets/images/pdfImg.svg" alt="Dosya Tipi">
        <div class="edit_containerImgFile-fileUpload-main">
            <div class="edit_containerImgFile-fileUpload-top">
                <span class="edit_containerImgFile-FileName">${file.name}</span>
                <p class="edit_containerImgFile-fileSize">${(
            file.size /
            (1024 * 1024)
        ).toFixed(2)} MB</p>
            </div>
            <div class="edit_containerImgFile-fileProgress">
                <div class="uploadLine" style="width:100%;"></div>
            </div>
        </div>
        <button class="edit_removeContainerImgFile" type="button">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    `;

    edit_containerImgFiles.appendChild(edit_containerImgFile_fileUpload); // Dosya div'ini container'a ekle

    // Progress Bar Efekti
    const edit_containerImgFile_fileProgress =
        edit_containerImgFile_fileUpload.querySelector(".uploadLine");
    edit_containerImgFile_fileProgress.style.width = "0%";

    setTimeout(() => {
        edit_containerImgFile_fileProgress.style.transition =
            "width 0.5s linear";
        edit_containerImgFile_fileProgress.style.width = "100%";
    }, 100);

    // Silme butonuna tıklanırsa dosya silinecek
    const removeBtn = edit_containerImgFile_fileUpload.querySelector(
        ".edit_removeContainerImgFile"
    );

    removeBtn?.addEventListener("click", () => {
        // Silinecek dosyanın uniqueID'sini al
        const uniqueID =
            edit_containerImgFile_fileUpload.getAttribute("data-id");

        // Bu dosyayı edit_uploadedFiles dizisinden çıkar
        edit_uploadedFiles = edit_uploadedFiles.filter(
            (f) => `${f.name}-${f.lastModified}` !== uniqueID
        );

        // DOM'dan öğeyi kaldır
        edit_containerImgFile_fileUpload.remove();
    });
}

// Modal açma işlemi
const edit_containerImgModal_container = document.querySelector(
    ".edit_containerImgModal_container"
);
const edit_closeContainerImgModal = document.querySelector(
    ".edit_closeContainerImgModal"
);
const edit_containerImgs = document.querySelectorAll(".edit_containerImg");

edit_containerImgs.forEach((edit_containerImg) => {
    edit_containerImg?.addEventListener("click", () => {
        edit_containerImgModal_container.classList.add("activeModal");
    });
});

// Modal kapatma işlemi
edit_closeContainerImgModal?.addEventListener("click", () => {
    edit_containerImgModal_container.classList.remove("activeModal");
});

//=======================================================================
document.querySelectorAll(".vendorFile").forEach((vendorFile) => {
    const vendorInput = vendorFile.querySelector('input[type="file"]');
    const vendorUploadArea = vendorFile.nextElementSibling;
    const fileNameSpan = vendorUploadArea.querySelector(".vendor-FileName");
    const fileSizeP = vendorUploadArea.querySelector(".vendor-fileSize");
    const uploadLine = vendorUploadArea.querySelector(".uploadLine");
    const removeFileBtn = vendorUploadArea.querySelector(".removeVendorFile");

    vendorInput?.addEventListener("change", async function () {
        if (this.files.length > 0) {
            vendorUploadArea.style.display = "flex";
            const file = this.files[0];

            fileNameSpan.textContent = file.name;
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
            fileSizeP.textContent = `${fileSizeMB} MB`;

            // Yükleme çubuğunu sıfırla ve animasyonu başlat
            uploadLine.style.transition = "none";
            uploadLine.style.width = "0%";
            await new Promise((resolve) => setTimeout(resolve, 100));
            uploadLine.style.transition = "width 0.5s linear";
            uploadAnimation(uploadLine);
        } else {
            fileNameSpan.textContent = "";
            fileSizeP.textContent = "";
            uploadLine.style.width = "0%";
        }
    });

    removeFileBtn?.addEventListener("click", () => {
        vendorInput.value = "";
        vendorUploadArea.style.display = "none";
    });
});

// 🔹 Yükleme Çubuğu Animasyonu
const uploadAnimation = (uploadLine) => {
    uploadLine.style.width = "100%";
};

const addVendor = document.querySelector(".addVendor");
const addVendor_modal_container = document.querySelector(
    ".addVendor_modal_container"
);
const closeVendorModal = document.querySelector(".closeVendorModal");

addVendor?.addEventListener("click", () => {
    addVendor_modal_container.classList.add("activeModal");
});

closeVendorModal?.addEventListener("click", () => {
    addVendor_modal_container.classList.remove("activeModal");
    vendorInput.value = "";
    vendor_fileUpload_area.style.display = "none";
    vendeor_fileNameSpan.textContent = "";
    vendor_fileSizeP.textContent = "";
    vendor_uploadLine.style.width = "0%";
});

const editVendors = document.querySelectorAll(".editVendor");
const editVendor_modal_container = document.querySelector(
    ".editVendor_modal_container"
);
const closeEditVendorModal = document.querySelector(".closeEditVendorModal");
editVendors.forEach((editVendor) => {
    editVendor?.addEventListener("click", () => {
        editVendor_modal_container.classList.add("activeModal");
    });
});

closeEditVendorModal?.addEventListener("click", () => {
    editVendor_modal_container.classList.remove("activeModal");
    // vendorInput.value = "";
    // vendor_fileUpload_area.style.display = "none";
    // vendeor_fileNameSpan.textContent = "";
    // vendor_fileSizeP.textContent = "";
    // vendor_uploadLine.style.width = "0%";
});

const viewVendors = document.querySelectorAll(".viewVendor");
const viewVendor_modal_container = document.querySelector(
    ".viewVendor_modal_container"
);
const closeViewVendorModal = document.querySelector(".closeViewVendorModal");

viewVendors.forEach((viewVendor) => {
    viewVendor?.addEventListener("click", () => {
        viewVendor_modal_container.classList.add("activeModal");
    });
});

closeViewVendorModal?.addEventListener("click", () => {
    viewVendor_modal_container.classList.remove("activeModal");
});

//=======================================================================
const receiptInput = document.querySelector('.receiptFile input[type="file"]');
const removeReceiptFile = document.querySelector(".removeReceiptFile");
const receipt_fileUpload_area = document.querySelector(
    ".receipt-fileUpload-area"
);
const receipt_fileNameSpan = document.querySelector(
    ".receipt-fileUpload-top .receipt-FileName"
);
const receipt_fileSizeP = document.querySelector(
    ".receipt-fileUpload-top .receipt-fileSize"
);
const receipt_uploadLine = document.querySelector(
    ".receipt-fileProgress .uploadLine"
);
receiptInput?.addEventListener("change", async function () {
    if (this.files.length > 0) {
        receipt_fileUpload_area.style.display = "flex";
        const file = this.files[0];
        receipt_fileNameSpan.textContent = file.name;

        // Dosya boyutunu MB olarak hesapla
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
        receipt_fileSizeP.textContent = `${fileSizeMB} MB`;

        // Yükleme çubuğunu sıfırla
        receipt_uploadLine.style.transition = "none";
        receipt_uploadLine.style.width = "0%";

        // 100ms gecikme ile animasyon sıfırlama
        await new Promise((resolve) => setTimeout(resolve, 100));

        receipt_uploadLine.style.transition = "width 0.5s linear";
        simulateFileUpload(receipt_uploadLine);
    } else {
        receipt_fileNameSpan.textContent = "";
        receipt_fileSizeP.textContent = "";
        receipt_uploadLine.style.width = "0%";
    }
});
removeReceiptFile?.addEventListener("click", () => {
    receiptInput.value = "";
    receipt_fileUpload_area.style.display = "none";
});

//=======================================================================
// document.querySelectorAll(".employeeFile-container").forEach((container) => {
//     const employeeFileInput = container.querySelector('input[type="file"]');
//     const employeeFileUpload = container.querySelector(
//         ".employeeFile-fileUpload"
//     );

//     // Sayfa yüklendiğinde mevcut dosyalar için silme eventini ekle
//     container.querySelectorAll(".removeEmployeeFile").forEach((item) => {
//         item.addEventListener("click", () => {
//             item.parentElement.remove();
//         });
//     });

//     employeeFileInput?.addEventListener("change", async () => {
//         if (employeeFileInput.files.length > 0) {
//             [...employeeFileInput.files].forEach(async (file) => {
//                 const employeeFileUploadArea = document.createElement("div");
//                 employeeFileUploadArea.className =
//                     "employeeFile-fileUpload-area";

//                 employeeFileUploadArea.innerHTML = `
//                   <img src="./assets/images/pdfImg.svg" alt="">
//                   <div class="employeeFile-fileUpload-main">
//                       <div class="employeeFile-fileUpload-top">
//                           <span class="employeeFile-FileName">${file.name
//                     }</span>
//                           <p class="employeeFile-fileSize">${(
//                         file.size /
//                         (1024 * 1024)
//                     ).toFixed(2)} MB</p>
//                       </div>
//                       <div class="employeeFile-fileProgress">
//                           <div class="uploadLine"></div>
//                       </div>
//                   </div>
//                   <button class="removeEmployeeFile" type="button">
//                       <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
//                           <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
//                       </svg>
//                   </button>
//               `;

//                 employeeFileUpload.appendChild(employeeFileUploadArea);

//                 const employeeFile_uploadLine =
//                     employeeFileUploadArea.querySelector(".uploadLine");
//                 employeeFile_uploadLine.style.transition = "none";
//                 employeeFile_uploadLine.style.width = "0%";

//                 await new Promise((resolve) => setTimeout(resolve, 100));

//                 employeeFile_uploadLine.style.transition = "width 0.5s linear";
//                 simulateFileUploadProgress(employeeFile_uploadLine);

//                 // Yeni eklenen butona silme eventini ekle
//                 const removeButton = employeeFileUploadArea.querySelector(
//                     ".removeEmployeeFile"
//                 );
//                 removeButton.addEventListener("click", () => {
//                     employeeFileUploadArea.remove();
//                 });
//             });
//         }
//         employeeFileInput.value = ""; // Aynı dosyayı tekrar seçebilmek için input temizlendi
//     });
// });

//=======================================================================
// document.querySelectorAll(".edit_employeeFile-container").forEach((container) => {
//         const edit_employeeFileInput =
//             container.querySelector('input[type="file"]');
//         const edit_employeeFileUpload = container.querySelector(
//             ".edit_employeeFile-fileUpload"
//         );

//         // Sayfa yüklendiğinde mevcut dosyalar için silme eventini ekle
//         container
//             .querySelectorAll(".removeEdit_EmployeeFile")
//             .forEach((item) => {
//                 item.addEventListener("click", () => {
//                     item.parentElement.remove();
//                 });
//             });

//         edit_employeeFileInput?.addEventListener("change", async () => {
//             if (edit_employeeFileInput.files.length > 0) {
//                 [...edit_employeeFileInput.files].forEach(async (file) => {
//                     const edit_employeeFileUploadArea =
//                         document.createElement("div");
//                     edit_employeeFileUploadArea.className =
//                         "edit_employeeFile-fileUpload-area";

//                     edit_employeeFileUploadArea.innerHTML = `
//                   <img src="./assets/images/pdfImg.svg" alt="">
//                   <div class="edit_employeeFile-fileUpload-main">
//                       <div class="edit_employeeFile-fileUpload-top">
//                           <span class="edit_employeeFile-FileName">${file.name
//                         }</span>
//                           <p class="edit_employeeFile-fileSize">${(
//                             file.size /
//                             (1024 * 1024)
//                         ).toFixed(2)} MB</p>
//                       </div>
//                       <div class="edit_employeeFile-fileProgress">
//                           <div class="uploadLine"></div>
//                       </div>
//                   </div>
//                   <button class="removeEdit_EmployeeFile" type="button">
//                       <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
//                           <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
//                       </svg>
//                   </button>
//               `;

//                     edit_employeeFileUpload.appendChild(
//                         edit_employeeFileUploadArea
//                     );

//                     const edit_employeeFile_uploadLine =
//                         edit_employeeFileUploadArea.querySelector(
//                             ".uploadLine"
//                         );
//                     edit_employeeFile_uploadLine.style.transition = "none";
//                     edit_employeeFile_uploadLine.style.width = "0%";

//                     await new Promise((resolve) => setTimeout(resolve, 100));

//                     edit_employeeFile_uploadLine.style.transition =
//                         "width 0.5s linear";
//                     simulateFileUploadProgress(edit_employeeFile_uploadLine);

//                     // Yeni eklenen butona silme eventini ekle
//                     const removeButton =
//                         edit_employeeFileUploadArea.querySelector(
//                             ".removeEdit_EmployeeFile"
//                         );
//                     removeButton.addEventListener("click", () => {
//                         edit_employeeFileUploadArea.remove();
//                     });
//                 });
//             }
//             edit_employeeFileInput.value = ""; // Aynı dosyayı tekrar seçebilmek için input temizlendi
//         });
//     });

//=======================================================================
document
    .querySelectorAll(".empPayAvanceFile-container")
    .forEach((container) => {
        const empPayAvanceFileInput =
            container.querySelector('input[type="file"]');
        const empPayAvanceFileUpload = container.querySelector(
            ".empPayAvanceFile-fileUpload"
        );

        // Sayfa yüklendiğinde mevcut dosyalar için silme eventini ekle
        container
            .querySelectorAll(".removeEmpPayAvanceFile")
            .forEach((item) => {
                item.addEventListener("click", () => {
                    item.parentElement.remove();
                });
            });

        empPayAvanceFileInput?.addEventListener("change", async () => {
            if (empPayAvanceFileInput.files.length > 0) {
                [...empPayAvanceFileInput.files].forEach(async (file) => {
                    const empPayAvanceFileUploadArea =
                        document.createElement("div");
                    empPayAvanceFileUploadArea.className =
                        "empPayAvanceFile-fileUpload-area";

                    empPayAvanceFileUploadArea.innerHTML = `
                  <img src="./assets/images/pdfImg.svg" alt="">
                  <div class="empPayAvanceFile-fileUpload-main">
                      <div class="empPayAvanceFile-fileUpload-top">
                          <span class="empPayAvanceFile-FileName">${file.name
                        }</span>
                          <p class="empPayAvanceFile-fileSize">${(
                            file.size /
                            (1024 * 1024)
                        ).toFixed(2)} MB</p>
                      </div>
                      <div class="empPayAvanceFile-fileProgress">
                          <div class="uploadLine"></div>
                      </div>
                  </div>
                  <button class="removeEmpPayAvanceFile" type="button">
                      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                  </button>
              `;

                    empPayAvanceFileUpload.appendChild(
                        empPayAvanceFileUploadArea
                    );

                    const empPayAvanceFile_uploadLine =
                        empPayAvanceFileUploadArea.querySelector(".uploadLine");
                    empPayAvanceFile_uploadLine.style.transition = "none";
                    empPayAvanceFile_uploadLine.style.width = "0%";

                    await new Promise((resolve) => setTimeout(resolve, 100));

                    empPayAvanceFile_uploadLine.style.transition =
                        "width 0.5s linear";
                    simulateFileUploadProgress(empPayAvanceFile_uploadLine);

                    // Yeni eklenen butona silme eventini ekle
                    const removeButton =
                        empPayAvanceFileUploadArea.querySelector(
                            ".removeEmpPayAvanceFile"
                        );
                    removeButton.addEventListener("click", () => {
                        empPayAvanceFileUploadArea.remove();
                    });
                });
            }
            empPayAvanceFileInput.value = ""; // Aynı dosyayı tekrar seçebilmek için input temizlendi
        });
    });

//=======================================================================
document
    .querySelectorAll(".empEditPayAvanceFile-container")
    .forEach((container) => {
        const empEditPayAvanceFileInput =
            container.querySelector('input[type="file"]');
        const empEditPayAvanceFileUpload = container.querySelector(
            ".empEditPayAvanceFile-fileUpload"
        );

        // Sayfa yüklendiğinde mevcut dosyalar için silme eventini ekle
        container
            .querySelectorAll(".removeEditEmpPayAvanceFile")
            .forEach((item) => {
                item.addEventListener("click", () => {
                    item.parentElement.remove();
                });
            });

        empEditPayAvanceFileInput?.addEventListener("change", async () => {
            if (empEditPayAvanceFileInput.files.length > 0) {
                [...empEditPayAvanceFileInput.files].forEach(async (file) => {
                    const empEditPayAvanceFileUploadArea =
                        document.createElement("div");
                    empEditPayAvanceFileUploadArea.className =
                        "empEditPayAvanceFile-fileUpload-area";

                    empEditPayAvanceFileUploadArea.innerHTML = `
                  <img src="./assets/images/pdfImg.svg" alt="">
                  <div class="empEditPayAvanceFile-fileUpload-main">
                      <div class="empEditPayAvanceFile-fileUpload-top">
                          <span class="empEditPayAvanceFile-FileName">${file.name
                        }</span>
                          <p class="empEditPayAvanceFile-fileSize">${(
                            file.size /
                            (1024 * 1024)
                        ).toFixed(2)} MB</p>
                      </div>
                      <div class="empEditPayAvanceFile-fileProgress">
                          <div class="uploadLine"></div>
                      </div>
                  </div>
                  <button class="removeEditEmpPayAvanceFile" type="button">
                      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                  </button>
              `;

                    empEditPayAvanceFileUpload.appendChild(
                        empEditPayAvanceFileUploadArea
                    );

                    const empEditPayAvanceFile_uploadLine =
                        empEditPayAvanceFileUploadArea.querySelector(
                            ".uploadLine"
                        );
                    empEditPayAvanceFile_uploadLine.style.transition = "none";
                    empEditPayAvanceFile_uploadLine.style.width = "0%";

                    await new Promise((resolve) => setTimeout(resolve, 100));

                    empEditPayAvanceFile_uploadLine.style.transition =
                        "width 0.5s linear";
                    simulateFileUploadProgress(empEditPayAvanceFile_uploadLine);

                    // Yeni eklenen butona silme eventini ekle
                    const removeButton =
                        empEditPayAvanceFileUploadArea.querySelector(
                            ".removeEditEmpPayAvanceFile"
                        );
                    removeButton.addEventListener("click", () => {
                        empEditPayAvanceFileUploadArea.remove();
                    });
                });
            }
            empEditPayAvanceFileInput.value = ""; // Aynı dosyayı tekrar seçebilmek için input temizlendi
        });
    });

const avanceCheck = document.querySelector(
    `.avanceCheck input[type="checkbox"]`
);
const payAvance = document.querySelector(".payAvance");

avanceCheck?.addEventListener("change", function () {
    if (this.checked) {
        payAvance.style.display = "block";
    } else {
        payAvance.style.display = "none";
    }
});
//=======================================================================
// document.querySelectorAll(".uploadImages-container").forEach((container) => {
//     const imgInput = container.querySelector('input[type="file"]');
//     const imagesFileUpload = container.querySelector(".images-fileUpload");

//     // Sayfa yüklendiğinde mevcut dosyalar için silme eventini ekle
//     container.querySelectorAll(".removeImgFile").forEach((item) => {
//         item.addEventListener("click", () => {
//             item.parentElement.remove();
//         });
//     });

//     imgInput?.addEventListener("change", async () => {
//         if (imgInput.files.length > 0) {
//             [...imgInput.files].forEach(async (file) => {
//                 const imgFileUploadArea = document.createElement("div");
//                 imgFileUploadArea.className = "img-fileUpload-area";

//                 imgFileUploadArea.innerHTML = `
//                   <img src="./assets/images/pdfImg.svg" alt="">
//                   <div class="img-fileUpload-main">
//                       <div class="img-fileUpload-top">
//                           <span class="img-FileName">${file.name}</span>
//                           <p class="img-fileSize">${(file.size / (1024 * 1024)).toFixed(2)} MB</p>
//                       </div>
//                       <div class="img-fileProgress">
//                           <div class="uploadLine"></div>
//                       </div>
//                   </div>
//                   <button class="removeImgFile" type="button">
//                       <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
//                           <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
//                       </svg>
//                   </button>
//               `;

//                 imagesFileUpload.appendChild(imgFileUploadArea);

//                 const img_uploadLine = imgFileUploadArea.querySelector(".uploadLine");
//                 img_uploadLine.style.transition = "none";
//                 img_uploadLine.style.width = "0%";

//                 await new Promise((resolve) => setTimeout(resolve, 100));

//                 img_uploadLine.style.transition = "width 0.5s linear";
//                 simulateFileUploadProgress(img_uploadLine);

//                 // Yeni eklenen butona silme eventini ekle
//                 const removeButton = imgFileUploadArea.querySelector(".removeImgFile");
//                 removeButton.addEventListener("click", () => {
//                     imgFileUploadArea.remove();
//                 });
//             });
//         }
//         //imgInput.value = ""; // Aynı dosyayı tekrar seçebilmek için input temizlendi
//     });
// });

// // Yükleme animasyonu fonksiyonu
// const simulateFileUploadProgress = (progressElement) => {
//     let progress = 0;
//     const interval = setInterval(() => {
//         progress += 10;
//         progressElement.style.width = `${progress}%`;
//         if (progress >= 100) clearInterval(interval);
//     }, 50);
// };

//=======================================================================
const addCustomer_modal_container = document.querySelector(
    ".addCustomer_modal_container"
);
const closeAddCustomer = document.querySelector(".closeAddCustomer");
const addCustomerBtn = document.querySelector(".addCustomerBtn");

addCustomerBtn?.addEventListener("click", () => {
    addCustomer_modal_container.classList.add("activeModal");
});

closeAddCustomer?.addEventListener("click", () => {
    addCustomer_modal_container.classList.remove("activeModal");
});

//=======================================================================

// const settingTable_operation_btns = document.querySelectorAll(
//     ".settingTable-operation-btn"
// );

// settingTable_operation_btns.forEach((btn) => {
//     btn.addEventListener("click", (e) => {
//         e.stopPropagation();
//         const parent = btn.parentElement;
//         if (parent.classList.contains("active")) {
//             parent.classList.remove("active");
//         } else {
//             settingTable_operation_btns.forEach((btn2) =>
//                 btn2.parentElement.classList.remove("active")
//             );
//             parent.classList.add("active");
//         }
//     });
// });
// document.addEventListener("click", (e) => {
//     settingTable_operation_btns.forEach((btn) => {
//         const parent = btn.parentElement;
//         if (!parent.contains(e.target)) {
//             parent.classList.remove("active");
//         }
//     });
// });

const delete_settingModal_container = document.querySelector(
    ".delete_settingModal_container"
);
const closeSettingModal = document.querySelector(".closeSettingModal");
const delete_setting_no = document.querySelector(".delete_setting_no");
const settingTable_deletes = document.querySelectorAll(".settingTable_delete");
settingTable_deletes.forEach((settingTable_delete) => {
    settingTable_delete?.addEventListener("click", () => {
        delete_settingModal_container.classList.add("activeModal");
    });
});
closeSettingModal?.addEventListener("click", () => {
    delete_settingModal_container.classList.remove("activeModal");
});
delete_setting_no?.addEventListener("click", () => {
    delete_settingModal_container.classList.remove("activeModal");
});

//==============================================================================
const avans_operation_btns = document.querySelectorAll(".avans-operation-btn");

// Butona tıklama
avans_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            avans_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    avans_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

//=========================================================

const detailReview_operation_btns = document.querySelectorAll(
    ".detailReview-operation-btn"
);

// Butona tıklama
detailReview_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            detailReview_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    detailReview_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});
//=============================================================================

const empPay_operation_btns = document.querySelectorAll(
    ".empPay-operation-btn"
);
empPay_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            empPay_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    empPay_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

//=============================================

const client_operation_btns = document.querySelectorAll(
    ".client-operation-btn"
);
client_operation_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const parent = btn.parentElement;
        if (parent.classList.contains("active")) {
            parent.classList.remove("active");
        } else {
            client_operation_btns.forEach((btn2) =>
                btn2.parentElement.classList.remove("active")
            );
            parent.classList.add("active");
        }
    });
});
document.addEventListener("click", (e) => {
    client_operation_btns.forEach((btn) => {
        const parent = btn.parentElement;
        if (!parent.contains(e.target)) {
            parent.classList.remove("active");
        }
    });
});

// Dashboard Start
document.addEventListener("DOMContentLoaded", () => {
    const box_inners = document.querySelectorAll(".konteyner-box .box-inner");
    box_inners.forEach((box_inner) => {
        if (box_inner.style.width == "0%") {
            box_inner.parentElement.classList.add("emptyKonteyner");
        } else if (
            box_inner.style.width > "0%" &&
            box_inner.style.width <= "50%"
        ) {
            box_inner.parentElement.classList.add("halfKonteyner");
        } else if (box_inner.style.width > "51%") {
            box_inner.parentElement.classList.add("fullKonteyner");
        }
    });
});
const date_boxes = document.querySelectorAll(".dashboard-container .date-box");
const containers = document.querySelectorAll(
    ".dashboard-konteyners .konteyner"
);
date_boxes.forEach((date_box) => {
    date_box?.addEventListener("click", () => {
        date_boxes.forEach((d) => d.classList.remove("active"));
        containers.forEach((c) => (c.style.display = "none"));
        date_box.classList.toggle("active");
        let id = date_box.id;
        document
            .querySelectorAll(
                `.dashboard-konteyners .konteyner[data-id="${id}"]`
            )
            .forEach((item) => {
                if (item.style.display == "none") {
                    item.style.display = "flex";
                } else {
                    item.style.display = "none";
                }
            });
    });
});
// Dashboard End
