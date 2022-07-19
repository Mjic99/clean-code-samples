import { LogLevel } from './log-level';

export interface Logger {
  log(message: string, logLevel: LogLevel): Promise<void>;
}
