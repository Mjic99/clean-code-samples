import { Logger } from '../loggers/logger';
import { LoggerFactory } from '../loggers/logger-factory';

export class BaseService {
  protected logger: Logger;

  constructor(protected loggerFactory: LoggerFactory) {
    this.logger = this.loggerFactory.create();
  }
}
