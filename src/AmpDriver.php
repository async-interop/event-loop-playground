<?php

namespace Playground;

use Amp\Reactor;
use Interop\Async\EventLoop\EventLoopDriver;

class AmpDriver implements EventLoopDriver {
    private $loop;

    public function __construct(Reactor $loop) {
        $this->loop = $loop;
    }

    /**
     * Start the event loop.
     *
     * @return void
     */
    public function run() {
        $this->loop->run();
    }

    /**
     * Stop the event loop.
     *
     * @return void
     */
    public function stop() {
        $this->loop->stop();
    }

    /**
     * Defer the execution of a callback.
     *
     * @param callable $callback The callback to defer.
     *
     * @return string An identifier that can be used to cancel, enable or disable the event.
     */
    public function defer(callable $callback) {
        return $this->loop->immediately($callback);
    }


    /**
     * Delay the execution of a callback. The time delay is approximate and accuracy is not guaranteed.
     *
     * @param callable $callback The callback to delay.
     * @param int      $delay The amount of time, in milliseconds, to delay the execution for.
     *
     * @return string An identifier that can be used to cancel, enable or disable the event.
     */
    public function delay(callable $callback, $delay) {
        return $this->loop->once($callback, $delay);
    }

    /**
     * Repeatedly execute a callback. The interval between executions is approximate and accuracy is not guaranteed.
     *
     * @param callable $callback The callback to repeat.
     * @param int      $interval The time interval, in milliseconds, to wait between executions.
     *
     * @return string An identifier that can be used to cancel, enable or disable the event.
     */
    public function repeat(callable $callback, $interval) {
        return $this->loop->repeat($callback, $interval);
    }

    /**
     * Execute a callback when a stream resource becomes readable.
     *
     * @param resource $stream The stream to monitor.
     * @param callable $callback The callback to execute.
     *
     * @return string An identifier that can be used to cancel, enable or disable the event.
     */
    public function onReadable($stream, callable $callback) {
        return $this->loop->onReadable($stream, $callback);
    }

    /**
     * Execute a callback when a stream resource becomes writable.
     *
     * @param resource $stream The stream to monitor.
     * @param callable $callback The callback to execute.
     *
     * @return string An identifier that can be used to cancel, enable or disable the event.
     */
    public function onWritable($stream, callable $callback) {
        return $this->loop->onWritable($stream, $callback);
    }

    /**
     * Execute a callback when a signal is received.
     *
     * @param int      $signo The signal number to monitor.
     * @param callable $callback The callback to execute.
     *
     * @return string An identifier that can be used to cancel, enable or disable the event.
     */
    public function onSignal($signo, callable $callback) {
        return $this->loop->onSignal($signo, $callback);
    }

    /**
     * Execute a callback when an error occurs.
     *
     * @param callable $callback The callback to execute.
     *
     * @return string An identifier that can be used to cancel, enable or disable the event.
     */
    public function onError(callable $callback) {
        throw new BadMethodCallException("Not implemented yet.");
    }

    /**
     * Enable an event.
     *
     * @param string $eventIdentifier The event identifier.
     *
     * @return void
     */
    public function enable($eventIdentifier) {
        $this->loop->enable($eventIdentifier);
    }

    /**
     * Disable an event.
     *
     * @param string $eventIdentifier The event identifier.
     *
     * @return void
     */
    public function disable($eventIdentifier) {
        $this->loop->disable($eventIdentifier);
    }

    /**
     * Cancel an event.
     *
     * @param string $eventIdentifier The event identifier.
     *
     * @return void
     */
    public function cancel($eventIdentifier) {
        $this->loop->cancel($eventIdentifier);
    }

    /**
     * Reference an event.
     *
     * This will keep the event loop alive whilst the event is still being monitored. Events have this state by default.
     *
     * @param string $eventIdentifier The event identifier.
     *
     * @return void
     */
    public function reference($eventIdentifier) {
        throw new BadMethodCallException("Not implemented yet.");
    }

    /**
     * Unreference an event.
     *
     * The event loop should exit the run method when only unreferenced events are still being monitored. Events are all
     * referenced by default.
     *
     * @param string $eventIdentifier The event identifier.
     *
     * @return void
     */
    public function unreference($eventIdentifier) {
        throw new BadMethodCallException("Not implemented yet.");
    }
}