export class FormTool {
    static buildFormData(payload, prefix = null) {
        const formData = new FormData();
        const getKeyname = (key) => (prefix ? `${prefix}[${key}]` : key);

        Object.keys(payload).forEach((key) => {
            if (Array.isArray(payload[key])) {
                for (let i = 0; i < payload[key].length; i++) {
                    if (payload[key][i]) {
                        formData.append(
                            getKeyname(key) + `[${i}]`,
                            payload[key][i]
                        );
                    }
                }
            } else if (payload[key]) {
                formData.append(getKeyname(key), payload[key]);
            }
        });

        return formData;
    }
}
