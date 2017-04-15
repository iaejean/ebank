export class Patterns {
    public static USERNAME = /^[a-z0-9-_]{5,15}$/;
    public static PASSWORD = /(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
    public static EMAIL = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    public static SLUG = /^[a-z0-9-]+$/;
    public static URL = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
    public static IP = /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
    public static HTML_TAG = /^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/;
    public static NUMBER = /\d/;
    public static EXTENSION_IMAGES = /([^\\s]+(?=\\.(jpg|gif|png))\\.\\2)/;
    public static NIP = /\d{4}/;
    public static CVV = /\d{3,4}/;
    public static CARD_NUMBER_SLUG = /\d{4}-d{4}-d{4}-d{2,4}/;
    public static CARD_NUMBER = /\d{14,16}/;
    public static CP = /\d{5}/;
    public static ADDRESS = /\w{2}/;
    public static DATE_FORMAT = "yyyy-MM-dd";
    public static DATE_FORMAT_C = "YYYY-MM-DD[T]HH:mm:ssZZ";
}
