# Yii2 Psr Log Source

This simple library implements a PSR compatible logger that routes all messages to a Yii Logger.
Use this if you have a library that needs such a logger and you want to forward the messages to your existing Logger.

## Logger adapter

The `Logger` adapter class takes a Yii `Logger` object and implements the `LoggerInterface`.

## DynamicLogger

Since Yii2 uses mutability a lot, the `Logger` adapter might hold a reference to an old Yii `Logger`. To work properly
with the Service Locator pattern we must use it on every call. `DynamicLogger` does this while internally using the `Logger`
and recreating it when needed.
