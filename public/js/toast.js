const showToast = ({
    message,
    type //primary, secondary, succes, danger, info, warning, light,dark
}) => {
    // configure color
    const alertContainer = document.getElementById("rootToast");
    const classForAlertContainer = `toast align-items-center text-white bg-${type} border-0`;
    alertContainer.className = classForAlertContainer;

    // configure title and message
    // const rootTitleAlert = document.getElementById("rootAlertTitle");
    const rootMessageAlert = document.getElementById("rootAlertMessage");
    // rootTitleAlert.innerHTML = title;
    rootMessageAlert.innerHTML = message;

    const rootToast = document.getElementById("rootToast");
    const toast = new bootstrap.Toast(rootToast);
    toast.show();
}