import { Injectable } from '@nestjs/common';
import { LogLevel } from './log-level';
import { LoggerImpl } from './logger-impl';

@Injectable()
export class ConsoleLogger extends LoggerImpl {
  getLogLevels(): LogLevel[] {
    return [LogLevel.INFO, LogLevel.WARN, LogLevel.ERROR];
  }

  logMessage(message: string) {
    console.log(`MESSAGE: "${message}" LOGGED IN CONSOLE`);
  }
}
