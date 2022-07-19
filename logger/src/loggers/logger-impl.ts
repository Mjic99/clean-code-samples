import { LogLevel } from './log-level';
import { Logger } from './logger';

export abstract class LoggerImpl implements Logger {
  private nextLogger: Logger;

  async log(message: string, logLevel: LogLevel) {
    if (this.getLogLevels().includes(logLevel)) {
      await this.logMessage(message);
    }
    if (this.nextLogger) {
      await this.nextLogger.log(message, logLevel);
    }
  }

  setNext(logger: Logger) {
    this.nextLogger = logger;
  }

  protected abstract getLogLevels(): LogLevel[];

  protected abstract logMessage(message: string);
}
