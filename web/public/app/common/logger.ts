/// <amd-dependency path="moment" name="moment"/>

declare let moment: any;

export interface LoggerInterface {
    /**
     * @param message
     */
    log(message: any): void;
    /**
     * @param message
     */
    info(message: any): void;
    /**
     * @param message
     */
    error(message: any): void;
    /**
     * @param message
     */
    debug(message: any): void;
    /**
     * @param message
     */
    warn(message: any): void;
}

export class Logger implements LoggerInterface {
    private static logger: any;
    private channel: string = "Default";

    /**
     * @param logger
     */
    public static setLogger(logger: any): void {
        this.logger = logger;
    }

    /***
     * @param channel
     * @returns {Logger}
     */
    public static getLogger(channel: string): Logger {
        let logger: Logger = new Logger();
        logger.channel = channel;
        return logger;
    }

    /**
     * @inheritDoc
     */
    public log(message: any): void {
        this.validMessage(message, "log");
    }

    /**
     * @inheritDoc
     */
    public info(message: any): void {
        this.validMessage(message, "info");
    }

    /**
     * @inheritDoc
     */
    public error(message: any): void {
        this.validMessage(message, "error");
    }

    /**
     * @inheritDoc
     */
    public debug(message: any): void {
        this.validMessage(message, "debug");
    }

    /**
     * @inheritDoc
     */
    public warn(message: any): void {
        this.validMessage(message, "warn");
    }

    /**
     * @param message
     * @param level
     */
    private validMessage(message: any, level: string): void {
        if ((/string|number|boolean/).test(typeof message)) {
            Logger.logger[level] ("[" + moment().format() + "] " + this.channel + " - " + message);
        } else {
            Logger.logger[level] ("[" + moment().format() + "] " + this.channel, message);
        }
    }
}
