import { Injectable } from '@nestjs/common';
import { LogLevel } from './loggers/log-level';
import { LoggerFactory } from './loggers/logger-factory';
import { BaseService } from './services/base.service';

@Injectable()
export class AppService extends BaseService {
  constructor(protected loggerFactory: LoggerFactory) {
    super(loggerFactory);
  }

  getHello(): string {
    this.logger.log('informative message', LogLevel.INFO);
    this.logger.log('warning', LogLevel.WARN);
    this.logger.log('An error is happening!', LogLevel.ERROR);
    return 'Hello World!';
  }
}
