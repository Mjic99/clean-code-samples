import { Injectable } from '@nestjs/common';
import { ConsoleLogger } from './console-logger';
import { Logger } from './logger';
import { SlackLogger } from './slack-logger';

@Injectable()
export class LoggerFactory {
  constructor(
    private consoleLogger: ConsoleLogger,
    private slackLogger: SlackLogger,
  ) {}

  create(): Logger {
    this.consoleLogger.setNext(this.slackLogger);
    return this.consoleLogger;
  }
}
