import { Module } from '@nestjs/common';
import { ConsoleLogger } from './console-logger';
import { LoggerFactory } from './logger-factory';
import { SlackLogger } from './slack-logger';

@Module({
  providers: [ConsoleLogger, SlackLogger, LoggerFactory],
  exports: [LoggerFactory],
})
export class LoggerModule {}
