import { Injectable } from '@nestjs/common';
import { LogLevel } from './log-level';
import { LoggerImpl } from './logger-impl';

@Injectable()
export class SlackLogger extends LoggerImpl {
  getLogLevels(): LogLevel[] {
    return [LogLevel.ERROR];
  }

  logMessage(message: string) {
    console.log(`MESSAGE: "${message}" LOGGED IN SLACK`);
  }
}
